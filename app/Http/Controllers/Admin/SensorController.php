<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Sensor;
use App\Models\Machine;
use Illuminate\Http\Request;

class SensorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sensors = Sensor::with('machine')->latest()->paginate(15);
        return view('admin.sensors.index', compact('sensors'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $machines = Machine::orderBy('name')->get(['id','name']);
        return view('admin.sensors.create', compact('machines'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'device_id' => 'required|string|max:100|unique:sensors,device_id',
            'machine_id' => 'nullable|exists:machines,id',
            'sensor_type' => 'required|string|max:100',
            'firmware_version' => 'nullable|string|max:50',
            'battery_level' => 'nullable|integer|min:0|max:100',
            'last_seen' => 'nullable|date',
            'status' => 'required|in:active,inactive,faulty,provisioning',
        ]);

        $sensor = Sensor::create($validated);
        return redirect()->route('admin.sensors.show', $sensor)->with('success', 'Sensor created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Sensor $sensor)
    {
        $sensor->load('machine');
        return view('admin.sensors.show', compact('sensor'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Sensor $sensor)
    {
        $machines = Machine::orderBy('name')->get(['id','name']);
        return view('admin.sensors.edit', compact('sensor','machines'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Sensor $sensor)
    {
        $validated = $request->validate([
            'device_id' => 'required|string|max:100|unique:sensors,device_id,'.$sensor->id,
            'machine_id' => 'nullable|exists:machines,id',
            'sensor_type' => 'required|string|max:100',
            'firmware_version' => 'nullable|string|max:50',
            'battery_level' => 'nullable|integer|min:0|max:100',
            'last_seen' => 'nullable|date',
            'status' => 'required|in:active,inactive,faulty,provisioning',
        ]);

        $sensor->update($validated);
        return redirect()->route('admin.sensors.show', $sensor)->with('success', 'Sensor updated.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Sensor $sensor)
    {
        $sensor->delete();
        return redirect()->route('admin.sensors.index')->with('success', 'Sensor deleted.');
    }
}
