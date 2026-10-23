<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Sensor;
use App\Models\Machine;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SensorController extends Controller
{
    public function index()
    {
        $sensors = Sensor::whereHas('machine', function($query) {
            $query->where('company_id', Auth::user()->company_id);
        })->with('machine')->latest()->paginate(10);
        return view('user.sensors.index', compact('sensors'));
    }

   

      public function show(Sensor $sensor)
    {
        $sensor->load('machine');
        return view('user.sensors.show', compact('sensor'));
    }

    public function create()
    {
        $machines = Machine::where('company_id', Auth::user()->company_id)->get();
        return view('user.sensors.create', compact('machines'));
    }

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

        // Check if machine belongs to user's company
        $machine = Machine::findOrFail($validated['machine_id']);
        if ($machine->company_id !== Auth::user()->company_id) {
            abort(403);
        }

        $sensor = Sensor::create($validated);

        return redirect()->route('user.sensors.index')
            ->with('success', 'Sensor created successfully');
    }

    public function edit(Sensor $sensor)
    {
        if ($sensor->machine->company_id !== Auth::user()->company_id) {
            abort(403);
        }
        $machines = Machine::where('company_id', Auth::user()->company_id)->get();
        return view('user.sensors.edit', compact('sensor', 'machines'));
    }

    public function update(Request $request, Sensor $sensor)
    {
        if ($sensor->machine->company_id !== Auth::user()->company_id) {
            abort(403);
        }

        $validated = $request->validate([
            'device_id' => 'required|string|max:100|unique:sensors,device_id,'.$sensor->id,
            'machine_id' => 'nullable|exists:machines,id',
            'sensor_type' => 'required|string|max:100',
            'firmware_version' => 'nullable|string|max:50',
            'battery_level' => 'nullable|integer|min:0|max:100',
            'last_seen' => 'nullable|date',
            'status' => 'required|in:active,inactive,faulty,provisioning',
        ]);

        // Check if new machine belongs to user's company
        $machine = Machine::findOrFail($validated['machine_id']);
        if ($machine->company_id !== Auth::user()->company_id) {
            abort(403);
        }

        $sensor->update($validated);

        return redirect()->route('user.sensors.index')
            ->with('success', 'Sensor updated successfully');
    }

    public function destroy(Sensor $sensor)
    {
        if ($sensor->machine->company_id !== Auth::user()->company_id) {
            abort(403);
        }

        $sensor->delete();

        return redirect()->route('user.sensors.index')
            ->with('success', 'Sensor deleted successfully');
    }
}