<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Alert;
use App\Models\Company;
use App\Models\Machine;
use App\Models\Sensor;
use App\Models\User;
use Illuminate\Http\Request;

class AlertController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $alerts = Alert::with(['company','machine','sensor'])->latest()->paginate(15);
        return view('admin.alerts.index', compact('alerts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $companies = Company::orderBy('name')->get(['id','name']);
        $machines = Machine::orderBy('name')->get(['id','name']);
        $sensors = Sensor::orderBy('device_id')->get(['id','device_id']);
        $users = User::orderBy('name')->get(['id','name']);
        return view('admin.alerts.create', compact('companies','machines','sensors','users'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'company_id' => 'required|exists:companies,id',
            'machine_id' => 'required|exists:machines,id',
            'sensor_id' => 'nullable|exists:sensors,id',
            'level' => 'required|in:info,warning,critical',
            'message' => 'required|string|max:500',
            'origin' => 'required|in:rule,prediction,manual,sensor',
            'payload' => 'nullable',
            'acknowledged_by' => 'nullable|exists:users,id',
            'acknowledged_at' => 'nullable|date',
        ]);

        if (!empty($validated['payload']) && is_string($validated['payload'])) {
            $decoded = json_decode($validated['payload'], true);
            $validated['payload'] = $decoded ?? $validated['payload'];
        }

        $alert = Alert::create($validated);
        return redirect()->route('admin.alerts.show', $alert)->with('success', 'Alert created.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Alert $alert)
    {
        $alert->load(['company','machine','sensor']);
        return view('admin.alerts.show', compact('alert'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Alert $alert)
    {
        $companies = Company::orderBy('name')->get(['id','name']);
        $machines = Machine::orderBy('name')->get(['id','name']);
        $sensors = Sensor::orderBy('device_id')->get(['id','device_id']);
        $users = User::orderBy('name')->get(['id','name']);
        return view('admin.alerts.edit', compact('alert','companies','machines','sensors','users'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Alert $alert)
    {
        $validated = $request->validate([
            'company_id' => 'required|exists:companies,id',
            'machine_id' => 'required|exists:machines,id',
            'sensor_id' => 'nullable|exists:sensors,id',
            'level' => 'required|in:info,warning,critical',
            'message' => 'required|string|max:500',
            'origin' => 'required|in:rule,prediction,manual,sensor',
            'payload' => 'nullable',
            'acknowledged_by' => 'nullable|exists:users,id',
            'acknowledged_at' => 'nullable|date',
        ]);

        if (!empty($validated['payload']) && is_string($validated['payload'])) {
            $decoded = json_decode($validated['payload'], true);
            $validated['payload'] = $decoded ?? $validated['payload'];
        }

        $alert->update($validated);
        return redirect()->route('admin.alerts.show', $alert)->with('success', 'Alert updated.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Alert $alert)
    {
        $alert->delete();
        return redirect()->route('admin.alerts.index')->with('success', 'Alert deleted.');
    }
}
