<?php

namespace App\Services;

class SensorDataGenerator
{
    public const SCENARIOS = [
        'normal' => 'Normal operation',
        'stress_test' => 'Stress test',
        'bearing_failure' => 'Bearing failure',
        'motor_overheating' => 'Motor overheating',
        'high_vibration' => 'High vibration',
        'pressure_leak' => 'Pressure leakage',
        'low_pressure' => 'Low pressure',
        'high_temperature' => 'High temperature',
        'sensor_malfunction' => 'Sensor malfunction',
        'power_fluctuation' => 'Power fluctuation',
        'communication_failure' => 'Communication failure',
        'emergency_shutdown' => 'Emergency shutdown',
        'preventive_maintenance' => 'Preventive maintenance',
        'scheduled_shutdown' => 'Scheduled shutdown',
        'component_replacement' => 'Component replacement',
        'inspection' => 'Inspection',
        'calibration' => 'Calibration',
        'lubrication' => 'Lubrication',
        'emergency_repair' => 'Emergency repair',
    ];

    public function generate(string $scenario, int $sequence, int $speed, float $temperatureOffset = 0): array
    {
        $phase = $sequence * max(1, $speed) / 5;
        $trend = sin($phase) * 0.04;
        $values = [
            'temperature' => 68 + ($trend * 68) + $this->noise(2.5) + $temperatureOffset,
            'pressure' => 120 + ($trend * 30) + $this->noise(4),
            'humidity' => 45 + ($trend * 10) + $this->noise(3),
            'vibration' => 2.3 + ($trend * 2) + $this->noise(0.35),
            'rpm' => 1450 + ($trend * 100) + $this->noise(18),
            'voltage' => 230 + ($trend * 8) + $this->noise(2),
            'current' => 9 + ($trend * 2) + $this->noise(0.5),
            'power' => 20 + ($trend * 6) + $this->noise(1.5),
            'energy' => 16 + ($sequence * max(1, $speed) * 0.02) + $this->noise(0.4),
            'flow_rate' => 40 + ($trend * 8) + $this->noise(2),
        ];

        switch ($scenario) {
            case 'stress_test':
                $values['temperature'] += 18;
                $values['vibration'] += 2.5;
                $values['current'] += 2;
                $values['power'] += 5;
                break;
            case 'bearing_failure':
                $values['vibration'] += 10;
                break;
            case 'high_vibration':
                $values['vibration'] += 8;
                break;
            case 'motor_overheating':
            case 'high_temperature':
                $values['temperature'] += 35;
                break;
            case 'pressure_leak':
                $values['pressure'] -= 45;
                $values['flow_rate'] -= 12;
                break;
            case 'low_pressure':
                $values['pressure'] -= 30;
                break;
            case 'power_fluctuation':
                $values['voltage'] += 18;
                $values['power'] += 12;
                break;
            case 'communication_failure':
                $values['communication_status'] = 'intermittent';
                break;
            case 'sensor_malfunction':
                $values['sensor_status'] = 'faulty';
                break;
            case 'emergency_shutdown':
                $values['rpm'] = 0;
                $values['power'] = 0;
                $values['flow_rate'] = 0;
                break;
            case 'preventive_maintenance':
            case 'component_replacement':
            case 'inspection':
            case 'calibration':
            case 'lubrication':
                $values['rpm'] *= 0.7;
                $values['power'] *= 0.7;
                break;
            case 'scheduled_shutdown':
            case 'emergency_repair':
                $values['rpm'] = 0;
                $values['power'] = 0;
                $values['flow_rate'] = 0;
                break;
        }

        foreach ($values as $key => $value) {
            if (is_numeric($value)) {
                $values[$key] = round((float) $value, 2);
            }
        }

        return $values;
    }

    private function noise(float $magnitude): float
    {
        return random_int(-100, 100) / 100 * $magnitude;
    }
}
