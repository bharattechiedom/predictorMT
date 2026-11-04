<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Sensor;
use App\Services\SensorReadingIngestionService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class SensorReadingController extends Controller
{
    public function store(Request $request, SensorReadingIngestionService $ingestion): JsonResponse
    {
        $validated = $request->validate([
            'sensor_id' => ['required', 'integer', 'exists:sensors,id'],
            'timestamp' => ['nullable', 'date'],
            'payload' => ['required', 'array:values'],
            'payload.values' => ['required', 'array:temperature,pressure,humidity,vibration,rpm,voltage,current,power,energy,flow_rate', 'min:1'],
            'payload.values.temperature' => ['nullable', 'numeric'],
            'payload.values.pressure' => ['nullable', 'numeric'],
            'payload.values.humidity' => ['nullable', 'numeric'],
            'payload.values.vibration' => ['nullable', 'numeric'],
            'payload.values.rpm' => ['nullable', 'numeric'],
            'payload.values.voltage' => ['nullable', 'numeric'],
            'payload.values.current' => ['nullable', 'numeric'],
            'payload.values.power' => ['nullable', 'numeric'],
            'payload.values.energy' => ['nullable', 'numeric'],
            'payload.values.flow_rate' => ['nullable', 'numeric'],
        ]);
        if (! array_filter($validated['payload']['values'], 'is_numeric')) {
            throw ValidationException::withMessages([
                'payload.values' => 'At least one numeric sensor value is required.',
            ]);
        }

        $sensor = Sensor::with('machine')->findOrFail($validated['sensor_id']);
        $companyId = $request->user()->company_id;

        if (! $companyId || ! $sensor->machine || (int) $sensor->machine->company_id !== (int) $companyId) {
            abort(403, 'The sensor does not belong to your company.');
        }

        $reading = $ingestion->store(
            $sensor,
            $validated['payload'],
            $validated['timestamp'] ?? null,
            'http'
        );

        return response()->json([
            'id' => $reading->id,
            'sensor_id' => $reading->sensor_id,
            'machine_id' => $reading->machine_id,
            'timestamp' => $reading->timestamp->toIso8601String(),
            'payload' => $reading->payload,
        ], 201);
    }
}
