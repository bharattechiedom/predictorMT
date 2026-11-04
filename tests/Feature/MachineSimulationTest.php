<?php

namespace Tests\Feature;

use App\Models\Alert;
use App\Models\Company;
use App\Models\Machine;
use App\Models\MaintenanceTask;
use App\Models\Sensor;
use App\Models\SensorReading;
use App\Models\User;
use App\Services\MachineSimulationService;
use App\Services\SystemSettings;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Artisan;
use Laravel\Sanctum\Sanctum;
use Mockery;
use Tests\TestCase;

class MachineSimulationTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_persists_sensor_data_and_records_fault_events(): void
    {
        [$user, $machine] = $this->createMachine();
        $simulator = app(MachineSimulationService::class);

        $simulator->start($machine, 'bearing_failure', 2, $user->id);
        $reading = $simulator->tick($machine);

        $this->assertInstanceOf(SensorReading::class, $reading);
        $this->assertSame('bearing_failure', $reading->payload['scenario']);
        $this->assertArrayHasKey('temperature', $reading->payload['values']);
        $this->assertArrayHasKey('pressure', $reading->payload['values']);
        $this->assertArrayHasKey('humidity', $reading->payload['values']);
        $this->assertArrayHasKey('vibration', $reading->payload['values']);
        $this->assertArrayHasKey('energy', $reading->payload['values']);
        $this->assertSame(2, Alert::where('machine_id', $machine->id)->count());
        $this->assertSame(1, MaintenanceTask::where('machine_id', $machine->id)->count());

        $simulator->pause($machine);
        $this->assertNull($simulator->tick($machine));
    }

    public function test_threshold_crossings_create_a_single_alert_for_the_run(): void
    {
        [$user, $machine] = $this->createMachine();
        $simulator = app(MachineSimulationService::class);
        $simulator->start($machine, 'normal', 1, $user->id, [
            'thresholds' => [
                'temperature_max' => 30,
                'pressure_min' => 0,
                'humidity_max' => 100,
                'vibration_max' => 100,
            ],
        ]);

        $simulator->tick($machine);
        $simulator->tick($machine);

        $this->assertSame(1, Alert::where('machine_id', $machine->id)->count());
    }

    public function test_scheduled_command_generates_readings_only_for_running_simulations(): void
    {
        [$user, $machine] = $this->createMachine();
        $simulator = app(MachineSimulationService::class);
        $simulator->start($machine, 'normal', 1, $user->id);

        Artisan::call('simulations:tick');

        $this->assertSame(1, SensorReading::where('machine_id', $machine->id)->count());
        $this->assertSame('running', data_get($machine->fresh()->metadata, 'simulation.operating_state'));

        $simulator->stop($machine);
        $this->assertSame('stopping', data_get($machine->fresh()->metadata, 'simulation.operating_state'));
        Artisan::call('simulations:tick');

        $this->assertSame(1, SensorReading::where('machine_id', $machine->id)->count());
        $this->assertSame('stopped', data_get($machine->fresh()->metadata, 'simulation.operating_state'));
    }

    public function test_scheduler_processes_simulations_across_batch_boundaries(): void
    {
        $company = Company::create(['name' => 'Batch Test Company']);
        $machines = collect(range(1, 101))->map(fn (int $number) => Machine::create([
            'company_id' => $company->id,
            'name' => 'Batch Test Machine '.$number,
            'machine_type' => 'Motor',
            'status' => 'healthy',
            'metadata' => [
                'simulation' => [
                    'status' => 'running',
                    'operating_state' => 'running',
                ],
            ],
        ]));
        $simulator = Mockery::mock(MachineSimulationService::class);
        $simulator->shouldReceive('tick')
            ->times(101)
            ->andReturnNull();
        $this->app->instance(MachineSimulationService::class, $simulator);

        $this->artisan('simulations:tick')
            ->expectsOutput('Generated 0 simulation reading(s).')
            ->assertSuccessful();

        $this->assertCount(101, $machines);
    }

    public function test_machine_operating_states_pause_or_stop_simulation_readings(): void
    {
        [$user, $machine] = $this->createMachine();
        $simulator = app(MachineSimulationService::class);
        $simulator->start($machine, 'normal', 1, $user->id);

        $this->actingAs($user)
            ->postJson(route('user.simulation.operating-state', $machine), ['state' => 'maintenance'])
            ->assertOk()
            ->assertJsonPath('operating_state', 'maintenance')
            ->assertJsonPath('status', 'paused');

        $this->assertNull($simulator->tick($machine));
        $this->postJson(route('user.simulation.start', $machine), [
            'scenario' => 'normal',
            'speed' => 1,
            'thresholds' => [
                'temperature_max' => 90,
                'pressure_min' => 70,
                'humidity_max' => 80,
                'vibration_max' => 8,
            ],
        ])->assertConflict();

        $this->postJson(route('user.simulation.operating-state', $machine), ['state' => 'ready'])
            ->assertOk()
            ->assertJsonPath('operating_state', 'ready');

        $this->postJson(route('user.simulation.start', $machine), [
            'scenario' => 'normal',
            'speed' => 1,
            'thresholds' => [
                'temperature_max' => 90,
                'pressure_min' => 70,
                'humidity_max' => 80,
                'vibration_max' => 8,
            ],
        ])->assertOk()
            ->assertJsonPath('simulation.operating_state', 'starting');

        $this->postJson(route('user.simulation.operating-state', $machine), ['state' => 'emergency_stop'])
            ->assertOk()
            ->assertJsonPath('status', 'stopped');

        $this->postJson(route('user.simulation.operating-state', $machine), ['state' => 'invalid'])
            ->assertUnprocessable();
    }

    public function test_simulation_uses_admin_threshold_defaults_when_no_overrides_are_provided(): void
    {
        [$user, $machine] = $this->createMachine();
        $thresholds = [
            'temperature_max' => 95,
            'pressure_min' => 65,
            'humidity_max' => 75,
            'vibration_max' => 7.5,
        ];
        app(SystemSettings::class)->saveSimulationThresholds($thresholds);

        $simulation = app(MachineSimulationService::class)->start($machine, 'normal', 1, $user->id);

        $this->assertSame($thresholds, $simulation['thresholds']);
    }

    public function test_start_endpoint_uses_admin_default_scenario_and_speed_when_omitted(): void
    {
        [$user, $machine] = $this->createMachine();
        app(SystemSettings::class)->saveSimulationDefaults([
            'scenario' => 'bearing_failure',
            'speed' => 5,
        ]);

        $this->actingAs($user)
            ->postJson(route('user.simulation.start', $machine), [
                'thresholds' => [
                    'temperature_max' => 90,
                    'pressure_min' => 70,
                    'humidity_max' => 80,
                    'vibration_max' => 8,
                ],
            ])
            ->assertOk()
            ->assertJsonPath('simulation.scenario', 'bearing_failure')
            ->assertJsonPath('simulation.speed', 5);
    }

    public function test_simulation_page_and_controls_are_company_scoped(): void
    {
        [$user, $machine] = $this->createMachine();
        app(SystemSettings::class)->saveSimulationThresholds([
            'temperature_max' => 95,
            'pressure_min' => 65,
            'humidity_max' => 75,
            'vibration_max' => 7.5,
        ]);
        $this->actingAs($user)
            ->get('/user/dashboard')
            ->assertOk()
            ->assertSee('HTTP ingestion');

        $this->getJson(route('user.dashboard.sensor-readings'))
            ->assertOk()
            ->assertJsonPath('machineCount', 1)
            ->assertJsonPath('events', []);

        Alert::create([
            'company_id' => $user->company_id,
            'machine_id' => $machine->id,
            'level' => 'warning',
            'message' => 'Live dashboard event',
            'origin' => 'rule',
        ]);
        $this->getJson(route('user.dashboard.sensor-readings'))
            ->assertOk()
            ->assertJsonPath('events.0.message', 'Live dashboard event')
            ->assertJsonPath('events.0.machine', $machine->name)
            ->assertJsonPath('events.0.acknowledged', false);

        $this->get('/user/simulation')
            ->assertOk()
            ->assertSee('Machinery simulation')
            ->assertSee('Temperature max')
            ->assertSee('value="95"', false);

        $this->postJson(route('user.simulation.start', $machine), [
            'scenario' => 'motor_overheating',
            'speed' => 2,
            'thresholds' => [
                'temperature_max' => 90,
                'pressure_min' => 70,
                'humidity_max' => 80,
                'vibration_max' => 8,
            ],
        ])->assertOk()
            ->assertJsonPath('status', 'running');

        [, $otherMachine] = $this->createMachine('other-simulation@example.test');
        $this->getJson(route('user.simulation.data', $otherMachine))->assertNotFound();
    }

    public function test_dashboard_reports_recent_and_stale_active_sensors_for_the_company(): void
    {
        [$user, $machine] = $this->createMachine();
        Sensor::create([
            'device_id' => 'RECENT-SENSOR',
            'machine_id' => $machine->id,
            'sensor_type' => 'temperature',
            'status' => 'active',
            'last_seen' => now()->subMinutes(2),
        ]);
        Sensor::create([
            'device_id' => 'STALE-SENSOR',
            'machine_id' => $machine->id,
            'sensor_type' => 'temperature',
            'status' => 'active',
            'last_seen' => now()->subMinutes(10),
        ]);
        Sensor::create([
            'device_id' => 'NEVER-SEEN-SENSOR',
            'machine_id' => $machine->id,
            'sensor_type' => 'temperature',
            'status' => 'active',
        ]);
        Sensor::create([
            'device_id' => 'INACTIVE-SENSOR',
            'machine_id' => $machine->id,
            'sensor_type' => 'temperature',
            'status' => 'inactive',
            'last_seen' => now(),
        ]);

        $this->actingAs($user)
            ->getJson(route('user.dashboard.sensor-readings'))
            ->assertOk()
            ->assertJsonPath('activeSensorCount', 3)
            ->assertJsonPath('connectedSensorCount', 1)
            ->assertJsonPath('staleSensorCount', 2)
            ->assertJsonPath('sensorFreshnessMinutes', 5);
    }

    public function test_history_endpoint_filters_dates_and_is_company_scoped(): void
    {
        [$user, $machine] = $this->createMachine();
        $sensor = Sensor::create([
            'device_id' => 'HISTORY-TEST-1',
            'machine_id' => $machine->id,
            'sensor_type' => 'multi-parameter',
            'status' => 'active',
        ]);
        SensorReading::create([
            'sensor_id' => $sensor->id,
            'machine_id' => $machine->id,
            'timestamp' => '2025-01-10 10:00:00',
            'payload' => ['scenario' => 'normal', 'values' => ['temperature' => 72.5]],
        ]);
        SensorReading::create([
            'sensor_id' => $sensor->id,
            'machine_id' => $machine->id,
            'timestamp' => '2025-01-11 10:00:00',
            'payload' => ['scenario' => 'normal', 'values' => ['temperature' => 73.5]],
        ]);

        $this->actingAs($user)
            ->getJson(route('user.simulation.history', $machine).'?from=2025-01-10T00:00&to=2025-01-10T23:59')
            ->assertOk()
            ->assertJsonPath('count', 1)
            ->assertJsonPath('truncated', false)
            ->assertJsonPath('readings.0.values.temperature', 72.5);

        [, $otherMachine] = $this->createMachine('history-other@example.test');
        $this->getJson(route('user.simulation.history', $otherMachine))->assertNotFound();
    }

    public function test_http_ingestion_accepts_company_owned_sensor_readings(): void
    {
        [$user, $machine] = $this->createMachine();
        $sensor = Sensor::create([
            'device_id' => 'HTTP-TEST-1',
            'machine_id' => $machine->id,
            'sensor_type' => 'multi-parameter',
            'status' => 'active',
        ]);
        Sanctum::actingAs($user);

        $response = $this->postJson('/api/sensor-readings', [
            'sensor_id' => $sensor->id,
            'payload' => ['values' => ['temperature' => 72.5, 'vibration' => 2.8]],
        ]);

        $response->assertCreated()
            ->assertJsonPath('payload.source', 'http');
        $this->assertDatabaseHas('sensor_readings', [
            'sensor_id' => $sensor->id,
            'machine_id' => $machine->id,
        ]);
    }

    public function test_http_ingestion_rejects_another_company_sensor(): void
    {
        [$user] = $this->createMachine();
        [, $otherMachine] = $this->createMachine('other@example.test');
        $sensor = Sensor::create([
            'device_id' => 'HTTP-TEST-2',
            'machine_id' => $otherMachine->id,
            'sensor_type' => 'temperature',
            'status' => 'active',
        ]);
        Sanctum::actingAs($user);

        $this->postJson('/api/sensor-readings', [
            'sensor_id' => $sensor->id,
            'payload' => ['values' => ['temperature' => 72.5]],
        ])->assertForbidden();
    }

    public function test_http_ingestion_rejects_unexpected_payload_fields(): void
    {
        [$user, $machine] = $this->createMachine();
        $sensor = Sensor::create([
            'device_id' => 'HTTP-TEST-XSS',
            'machine_id' => $machine->id,
            'sensor_type' => 'temperature',
            'status' => 'active',
        ]);
        Sanctum::actingAs($user);

        $this->postJson('/api/sensor-readings', [
            'sensor_id' => $sensor->id,
            'payload' => [
                'values' => ['temperature' => 72.5],
                'scenario' => '<script>alert(1)</script>',
            ],
        ])->assertUnprocessable()
            ->assertJsonValidationErrors('payload');

        $this->assertSame(0, SensorReading::where('sensor_id', $sensor->id)->count());
    }

    private function createMachine(string $email = 'simulator@example.test'): array
    {
        $company = Company::create(['name' => 'Simulation Test']);
        $user = User::create([
            'company_id' => $company->id,
            'name' => 'Simulation User',
            'email' => $email,
            'password' => 'password',
            'role' => 'viewer',
        ]);
        $machine = Machine::create([
            'company_id' => $company->id,
            'name' => 'Test Motor',
            'machine_type' => 'Motor',
            'status' => 'healthy',
        ]);

        return [$user, $machine];
    }
}
