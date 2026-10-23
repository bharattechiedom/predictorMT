<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SensorReading;
use App\Models\Sensor;
use App\Models\Machine;
use Illuminate\Http\Request;

class SensorReadingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $readings = SensorReading::with(['sensor','machine'])->latest('timestamp')->paginate(20);
        return view('admin.sensor-readings.index', compact('readings'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $sensors = Sensor::orderBy('device_id')->get(['id','device_id']);
        $machines = Machine::orderBy('name')->get(['id','name']);
        return view('admin.sensor-readings.create', compact('sensors','machines'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'sensor_id' => 'required|exists:sensors,id',
            'machine_id' => 'required|exists:machines,id',
            'timestamp' => 'required|date',
            'payload' => 'nullable',
            'value_float' => 'nullable|numeric',
        ]);

        // payload can be JSON string; decode if provided
        if (!empty($validated['payload']) && is_string($validated['payload'])) {
            $decoded = json_decode($validated['payload'], true);
            $validated['payload'] = $decoded ?? $validated['payload'];
        }

        $reading = SensorReading::create($validated);
        return redirect()->route('admin.sensor-readings.show', $reading)->with('success', 'Reading created.');
    }

    /**
     * Display the specified resource.
     */
    public function show(SensorReading $sensor_reading)
    {
        $sensor_reading->load(['sensor','machine']);
        return view('admin.sensor-readings.show', ['reading' => $sensor_reading]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(SensorReading $sensor_reading)
    {
        $sensors = Sensor::orderBy('device_id')->get(['id','device_id']);
        $machines = Machine::orderBy('name')->get(['id','name']);
        return view('admin.sensor-readings.edit', ['reading' => $sensor_reading, 'sensors' => $sensors, 'machines' => $machines]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, SensorReading $sensor_reading)
    {
        $validated = $request->validate([
            'sensor_id' => 'required|exists:sensors,id',
            'machine_id' => 'required|exists:machines,id',
            'timestamp' => 'required|date',
            'payload' => 'nullable',
            'value_float' => 'nullable|numeric',
        ]);

        if (!empty($validated['payload']) && is_string($validated['payload'])) {
            $decoded = json_decode($validated['payload'], true);
            $validated['payload'] = $decoded ?? $validated['payload'];
        }

        $sensor_reading->update($validated);
        return redirect()->route('admin.sensor-readings.show', $sensor_reading)->with('success', 'Reading updated.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SensorReading $sensor_reading)
    {
        $sensor_reading->delete();
        return redirect()->route('admin.sensor-readings.index')->with('success', 'Reading deleted.');
    }
}
