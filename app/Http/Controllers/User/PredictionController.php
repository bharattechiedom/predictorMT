<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Prediction;
use App\Models\Machine;
use App\Models\MaintenanceTask;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PredictionController extends Controller
{
    public function index()
    {
        $predictions = Prediction::whereHas('machine', function($query) {
            $query->where('company_id', Auth::user()->company_id);
        })->with(['machine', 'sensor'])
            ->latest()
            ->paginate(10);
        return view('user.predictions.index', compact('predictions'));
    }

    public function show(Prediction $prediction)
    {
        if ($prediction->machine->company_id !== Auth::user()->company_id) {
            abort(403);
        }
        return view('user.predictions.show', compact('prediction'));
    }

    public function acknowledge(Prediction $prediction)
    {
        if ($prediction->machine->company_id !== Auth::user()->company_id) {
            abort(403);
        }

        if ($prediction->status === 'open') {
            $prediction->update([
                'status' => 'acknowledged'
            ]);
        }

        return redirect()->back()
            ->with('success', 'Prediction acknowledged successfully');
    }

    public function convert(Request $request, Prediction $prediction)
    {
        if ($prediction->machine->company_id !== Auth::user()->company_id) {
            abort(403);
        }

        $validated = $request->validate([
            'scheduled_at' => 'required|date',
            'notes' => 'nullable|string',
            'assigned_to' => 'nullable|exists:users,id',
        ]);

        // Create maintenance task from prediction
        $task = MaintenanceTask::create([
            'company_id' => Auth::user()->company_id,
            'machine_id' => $prediction->machine_id,
            'created_by' => Auth::id(),
            'assigned_to' => $validated['assigned_to'] ?? null,
            'scheduled_at' => $validated['scheduled_at'],
            'status' => 'scheduled',
            'notes' => $validated['notes'] ?? "Created from prediction #" . $prediction->id,
        ]);

        // Update prediction status
        $prediction->update([
            'status' => 'converted'
        ]);

        return redirect()->route('user.maintenance-tasks.show', $task)
            ->with('success', 'Prediction converted to maintenance task successfully');
    }

    public function resolve(Prediction $prediction)
    {
        if ($prediction->machine->company_id !== Auth::user()->company_id) {
            abort(403);
        }

        if (in_array($prediction->status, ['open', 'acknowledged'])) {
            $prediction->update([
                'status' => 'resolved'
            ]);
        }

        return redirect()->back()
            ->with('success', 'Prediction marked as resolved');
    }
}