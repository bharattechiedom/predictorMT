<?php

namespace Tests\Unit;

use App\Services\SensorDataGenerator;
use PHPUnit\Framework\TestCase;

class SensorDataGeneratorTest extends TestCase
{
    public function test_it_generates_the_required_sensor_channels(): void
    {
        $values = (new SensorDataGenerator)->generate('normal', 1, 1);

        $this->assertSame([
            'temperature',
            'pressure',
            'humidity',
            'vibration',
            'rpm',
            'voltage',
            'current',
            'power',
            'energy',
            'flow_rate',
        ], array_keys($values));
        $this->assertContainsOnly('float', $values);
    }

    public function test_fault_scenarios_apply_their_expected_sensor_signatures(): void
    {
        $generator = new SensorDataGenerator;

        $this->assertGreaterThan(
            9,
            $generator->generate('bearing_failure', 1, 1)['vibration']
                - $generator->generate('normal', 1, 1)['vibration']
        );
        $this->assertSame(0.0, $generator->generate('emergency_shutdown', 1, 1)['rpm']);
        $this->assertSame('intermittent', $generator->generate('communication_failure', 1, 1)['communication_status']);
    }
}
