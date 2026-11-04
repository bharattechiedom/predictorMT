<?php

namespace App\Services;

use App\Models\Sensor;
use App\Models\SensorReading;
use Illuminate\Support\Facades\DB;

class SensorReadingIngestionService
{
    public function store(Sensor $sensor, array $payload, ?string $timestamp, string $source): SensorReading
    {
        return DB::transaction(function () use ($sensor, $payload, $timestamp, $source) {
            $sensor->loadMissing('machine');
            $machine = $sensor->machine;

            if (! $machine) {
                throw new \RuntimeException('Cannot ingest a reading for a sensor without a machine.');
            }

            $values = $payload['values'];
            $reading = SensorReading::create([
                'sensor_id' => $sensor->id,
                'machine_id' => $machine->id,
                'timestamp' => $timestamp ?? now(),
                'payload' => array_merge($payload, ['source' => $source]),
                'value_float' => $values['temperature'] ?? null,
            ]);

            $sensor->forceFill(['last_seen' => now()])->save();

            return $reading;
        });
    }
}
