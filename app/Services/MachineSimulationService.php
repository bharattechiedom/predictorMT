<?php

namespace App\Services;

use App\Models\Alert;
use App\Models\Machine;
use App\Models\MaintenanceTask;
use App\Models\SensorReading;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class MachineSimulationService
{
    public function __construct(
        private SensorDataGenerator $generator,
        private MqttSensorPublisher $mqttPublisher,
        private SystemSettings $systemSettings
    ) {}

    public function start(Machine $machine, string $scenario, int $speed, int $userId, array $settings = []): array
    {
        return DB::transaction(function () use ($machine, $scenario, $speed, $userId, $settings) {
            $machine = Machine::query()->lockForUpdate()->findOrFail($machine->id);
            $metadata = $machine->metadata ?? [];
            $previous = $metadata['simulation'] ?? [];
            if (in_array($previous['operating_state'] ?? null, ['maintenance', 'fault', 'emergency_stop', 'stopping'], true)) {
                throw new \DomainException('Set the machine to Ready before starting the simulation.');
            }
            $thresholds = array_merge($this->systemSettings->simulationThresholds(), $settings['thresholds'] ?? []);
            $newRun = ($previous['status'] ?? 'stopped') === 'stopped'
                || ($previous['scenario'] ?? null) !== $scenario;
            $settingsChanged = ($previous['thresholds'] ?? []) !== $thresholds
                || (float) ($previous['temperature_offset'] ?? 0) !== (float) ($settings['temperature_offset'] ?? 0);
            $now = now();

            $metadata['simulation'] = array_merge($previous, [
                'status' => 'running',
                'operating_state' => 'starting',
                'scenario' => $scenario,
                'speed' => $speed,
                'sequence' => $newRun ? 0 : (int) ($previous['sequence'] ?? 0),
                'thresholds' => $thresholds,
                'temperature_offset' => (float) ($settings['temperature_offset'] ?? 0),
                'triggered_thresholds' => ($newRun || $settingsChanged) ? [] : ($previous['triggered_thresholds'] ?? []),
                'started_at' => $newRun ? $now->toIso8601String() : ($previous['started_at'] ?? $now->toIso8601String()),
                'updated_at' => $now->toIso8601String(),
            ]);
            $machine->metadata = $metadata;
            $machine->save();

            if ($newRun) {
                $this->recordScenarioEvent($machine, $scenario, $userId);
            }

            return $metadata['simulation'];
        });
    }

    public function pause(Machine $machine): array
    {
        return $this->updateStatus($machine, 'paused', 'paused');
    }

    public function stop(Machine $machine): array
    {
        return $this->updateStatus($machine, 'stopped', 'stopping');
    }

    public function completeStopping(Machine $machine): array
    {
        return $this->updateStatus($machine, 'stopped', 'stopped');
    }

    public function setOperatingState(Machine $machine, string $state): array
    {
        $status = match ($state) {
            'ready' => 'stopped',
            'maintenance', 'fault' => 'paused',
            'emergency_stop' => 'stopped',
            default => throw new \InvalidArgumentException('Unsupported machine operating state.'),
        };

        return $this->updateStatus($machine, $status, $state);
    }

    public function tick(Machine $machine): ?SensorReading
    {
        $reading = DB::transaction(function () use ($machine) {
            $machine = Machine::query()->lockForUpdate()->findOrFail($machine->id);
            $metadata = $machine->metadata ?? [];
            $simulation = $metadata['simulation'] ?? [];

            if (($simulation['status'] ?? 'stopped') !== 'running') {
                return null;
            }

            if (($simulation['operating_state'] ?? null) === 'starting') {
                $simulation['operating_state'] = 'running';
            }

            $sequence = (int) ($simulation['sequence'] ?? 0) + 1;
            $scenario = $simulation['scenario'] ?? 'normal';
            $speed = (int) ($simulation['speed'] ?? 1);
            $values = $this->generator->generate(
                $scenario,
                $sequence,
                $speed,
                (float) ($simulation['temperature_offset'] ?? 0)
            );
            $sensor = $machine->sensors()->orderBy('id')->first();

            if (! $sensor) {
                $sensor = $machine->sensors()->create([
                    'device_id' => 'SIM-'.$machine->id.'-'.Str::uuid(),
                    'sensor_type' => 'simulation',
                    'status' => 'active',
                ]);
            }

            $sensor->forceFill(['last_seen' => now()])->save();
            $reading = SensorReading::create([
                'sensor_id' => $sensor->id,
                'machine_id' => $machine->id,
                'timestamp' => now(),
                'payload' => [
                    'source' => 'simulation',
                    'scenario' => $scenario,
                    'sequence' => $sequence,
                    'speed' => $speed,
                    'units' => [
                        'temperature' => '°C',
                        'pressure' => 'PSI',
                        'humidity' => '%',
                        'vibration' => 'mm/s',
                        'rpm' => 'rpm',
                        'voltage' => 'V',
                        'current' => 'A',
                        'power' => 'kW',
                        'energy' => 'kWh',
                        'flow_rate' => 'L/min',
                    ],
                    'values' => $values,
                ],
                'value_float' => $values['temperature'],
            ]);

            $this->recordThresholdAlerts($machine, $simulation, $values);
            $simulation['sequence'] = $sequence;
            $simulation['updated_at'] = now()->toIso8601String();
            $metadata['simulation'] = $simulation;
            $machine->metadata = $metadata;
            $machine->save();

            return $reading;
        });

        if ($reading) {
            $this->mqttPublisher->publish($reading);
        }

        return $reading;
    }

    private function updateStatus(Machine $machine, string $status, string $operatingState): array
    {
        return DB::transaction(function () use ($machine, $status, $operatingState) {
            $machine = Machine::query()->lockForUpdate()->findOrFail($machine->id);
            $metadata = $machine->metadata ?? [];
            $simulation = $metadata['simulation'] ?? [];
            $simulation['status'] = $status;
            $simulation['operating_state'] = $operatingState;
            $simulation['updated_at'] = now()->toIso8601String();
            $metadata['simulation'] = $simulation;
            $machine->metadata = $metadata;
            $machine->save();

            return $simulation;
        });
    }

    private function recordScenarioEvent(Machine $machine, string $scenario, int $userId): void
    {
        if ($scenario === 'normal' || $scenario === 'stress_test') {
            return;
        }

        $label = SensorDataGenerator::SCENARIOS[$scenario] ?? $scenario;
        $now = now();

        Alert::create([
            'company_id' => $machine->company_id,
            'machine_id' => $machine->id,
            'level' => $scenario === 'emergency_shutdown' ? 'critical' : 'warning',
            'message' => 'Simulation scenario started: '.$label,
            'origin' => 'rule',
            'payload' => ['source' => 'simulation', 'scenario' => $scenario],
        ]);

        MaintenanceTask::create([
            'company_id' => $machine->company_id,
            'machine_id' => $machine->id,
            'created_by' => $userId,
            'scheduled_at' => $now,
            'status' => 'scheduled',
            'notes' => 'Simulation event: '.$label.'. Review the generated sensor readings before taking action.',
        ]);
    }

    private function recordThresholdAlerts(Machine $machine, array &$simulation, array $values): void
    {
        $thresholds = array_merge($this->systemSettings->simulationThresholds(), $simulation['thresholds'] ?? []);
        $checks = [
            'temperature_max' => [
                'metric' => 'temperature',
                'condition' => fn ($value) => $value > $thresholds['temperature_max'],
                'message' => 'Temperature exceeded the configured limit.',
            ],
            'pressure_min' => [
                'metric' => 'pressure',
                'condition' => fn ($value) => $value < $thresholds['pressure_min'],
                'message' => 'Pressure fell below the configured limit.',
            ],
            'humidity_max' => [
                'metric' => 'humidity',
                'condition' => fn ($value) => $value > $thresholds['humidity_max'],
                'message' => 'Humidity exceeded the configured limit.',
            ],
            'vibration_max' => [
                'metric' => 'vibration',
                'condition' => fn ($value) => $value > $thresholds['vibration_max'],
                'message' => 'Vibration exceeded the configured limit.',
            ],
        ];
        $triggered = $simulation['triggered_thresholds'] ?? [];

        foreach ($checks as $key => $check) {
            $value = $values[$check['metric']] ?? null;

            if (isset($triggered[$key]) || ! is_numeric($value) || ! $check['condition']($value)) {
                continue;
            }

            Alert::create([
                'company_id' => $machine->company_id,
                'machine_id' => $machine->id,
                'level' => 'critical',
                'message' => $check['message'],
                'origin' => 'rule',
                'payload' => [
                    'source' => 'simulation',
                    'type' => 'threshold',
                    'metric' => $check['metric'],
                    'value' => $value,
                    'threshold' => $thresholds[$key],
                ],
            ]);
            $triggered[$key] = true;
        }

        $simulation['triggered_thresholds'] = $triggered;
    }
}
