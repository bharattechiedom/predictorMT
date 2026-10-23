<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MaintenanceTask;
use App\Models\Company;
use App\Models\Machine;
use App\Models\User;
use Illuminate\Http\Request;

class MaintenanceTaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tasks = MaintenanceTask::with(['machine','company'])->latest()->paginate(15);
        return view('admin.maintenance-tasks.index', compact('tasks'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $companies = Company::orderBy('name')->get(['id','name']);
        $machines = Machine::orderBy('name')->get(['id','name']);
        $users = User::orderBy('name')->get(['id','name']);
        return view('admin.maintenance-tasks.create', compact('companies','machines','users'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'company_id' => 'required|exists:companies,id',
            'machine_id' => 'required|exists:machines,id',
            'created_by' => 'required|exists:users,id',
            'assigned_to' => 'nullable|exists:users,id',
            'scheduled_at' => 'nullable|date',
            'completed_at' => 'nullable|date',
            'status' => 'required|in:scheduled,in_progress,completed,cancelled',
            'notes' => 'nullable|string',
            'parts_required' => 'nullable',
            'cost_estimate' => 'nullable|numeric',
        ]);

        if (!empty($validated['parts_required']) && is_string($validated['parts_required'])) {
            $decoded = json_decode($validated['parts_required'], true);
            $validated['parts_required'] = $decoded ?? $validated['parts_required'];
        }

        $task = MaintenanceTask::create($validated);
        return redirect()->route('admin.maintenance-tasks.show', $task)->with('success', 'Task created.');
    }

    /**
     * Display the specified resource.
     */
    public function show(MaintenanceTask $maintenance_task)
    {
        $maintenance_task->load(['company','machine']);
        return view('admin.maintenance-tasks.show', ['task' => $maintenance_task]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(MaintenanceTask $maintenance_task)
    {
        $companies = Company::orderBy('name')->get(['id','name']);
        $machines = Machine::orderBy('name')->get(['id','name']);
        $users = User::orderBy('name')->get(['id','name']);
        return view('admin.maintenance-tasks.edit', ['task' => $maintenance_task, 'companies' => $companies, 'machines' => $machines, 'users' => $users]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, MaintenanceTask $maintenance_task)
    {
        $validated = $request->validate([
            'company_id' => 'required|exists:companies,id',
            'machine_id' => 'required|exists:machines,id',
            'created_by' => 'required|exists:users,id',
            'assigned_to' => 'nullable|exists:users,id',
            'scheduled_at' => 'nullable|date',
            'completed_at' => 'nullable|date',
            'status' => 'required|in:scheduled,in_progress,completed,cancelled',
            'notes' => 'nullable|string',
            'parts_required' => 'nullable',
            'cost_estimate' => 'nullable|numeric',
        ]);

        if (!empty($validated['parts_required']) && is_string($validated['parts_required'])) {
            $decoded = json_decode($validated['parts_required'], true);
            $validated['parts_required'] = $decoded ?? $validated['parts_required'];
        }

        $maintenance_task->update($validated);
        return redirect()->route('admin.maintenance-tasks.show', $maintenance_task)->with('success', 'Task updated.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(MaintenanceTask $maintenance_task)
    {
        $maintenance_task->delete();
        return redirect()->route('admin.maintenance-tasks.index')->with('success', 'Task deleted.');
    }
}
