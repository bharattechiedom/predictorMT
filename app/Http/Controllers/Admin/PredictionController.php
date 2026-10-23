<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Prediction;
use App\Models\Machine;
use App\Models\Sensor;
use Illuminate\Http\Request;

class PredictionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $predictions = Prediction::with(['machine','sensor'])->latest('predicted_at')->paginate(15);
        return view('admin.predictions.index', compact('predictions'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $machines = Machine::orderBy('name')->get(['id','name']);
        $sensors = Sensor::orderBy('device_id')->get(['id','device_id']);
        return view('admin.predictions.create', compact('machines','sensors'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'machine_id' => 'required|exists:machines,id',
            'sensor_id' => 'nullable|exists:sensors,id',
            'predicted_at' => 'required|date',
            'predicted_failure_at' => 'nullable|date',
            'probability' => 'nullable|numeric|min:0|max:1',
            'component' => 'nullable|string|max:150',
            'model_version' => 'required|string|max:50',
            'explanation' => 'nullable',
            'status' => 'required|in:open,acknowledged,converted,resolved',
        ]);

        if (!empty($validated['explanation']) && is_string($validated['explanation'])) {
            $decoded = json_decode($validated['explanation'], true);
            $validated['explanation'] = $decoded ?? $validated['explanation'];
        }

        $prediction = Prediction::create($validated);
        return redirect()->route('admin.predictions.show', $prediction)->with('success', 'Prediction created.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Prediction $prediction)
    {
        $prediction->load(['machine','sensor']);
        return view('admin.predictions.show', compact('prediction'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Prediction $prediction)
    {
        $machines = Machine::orderBy('name')->get(['id','name']);
        $sensors = Sensor::orderBy('device_id')->get(['id','device_id']);
        return view('admin.predictions.edit', compact('prediction','machines','sensors'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Prediction $prediction)
    {
        $validated = $request->validate([
            'machine_id' => 'required|exists:machines,id',
            'sensor_id' => 'nullable|exists:sensors,id',
            'predicted_at' => 'required|date',
            'predicted_failure_at' => 'nullable|date',
            'probability' => 'nullable|numeric|min:0|max:1',
            'component' => 'nullable|string|max:150',
            'model_version' => 'required|string|max:50',
            'explanation' => 'nullable',
            'status' => 'required|in:open,acknowledged,converted,resolved',
        ]);

        if (!empty($validated['explanation']) && is_string($validated['explanation'])) {
            $decoded = json_decode($validated['explanation'], true);
            $validated['explanation'] = $decoded ?? $validated['explanation'];
        }

        $prediction->update($validated);
        return redirect()->route('admin.predictions.show', $prediction)->with('success', 'Prediction updated.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Prediction $prediction)
    {
        $prediction->delete();
        return redirect()->route('admin.predictions.index')->with('success', 'Prediction deleted.');
    }
}
