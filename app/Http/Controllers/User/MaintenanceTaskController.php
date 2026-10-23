<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\MaintenanceTask;
use App\Models\Machine;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MaintenanceTaskController extends Controller
{
   public function index()
    {
        $tasks = MaintenanceTask::where('company_id', Auth::user()->company_id)
            ->with(['machine', 'createdBy', 'assignedTo'])
            ->latest()
            ->paginate(10);
        $machines = Machine::where('company_id', Auth::user()->company_id)->get();
        return view('user.maintenance-tasks.index', compact('tasks', 'machines'));
    }

    public function show($id)
    {
        $task = MaintenanceTask::with(['machine', 'createdBy', 'assignedTo'])
            ->where('company_id', Auth::user()->company_id)
            ->findOrFail($id);

        if ($task->company_id !== Auth::user()->company_id) {
            abort(403);
        }
        return view('user.maintenance-tasks.show', compact('task'));
    }

    public function create()
{
    $machines = Machine::where('company_id', Auth::user()->company_id)->get();

    // $technicians = User::where('company_id', Auth::user()->company_id)
    //     ->where('role', 'technician')
    //     ->get();
    


    $technicians = User::where('role', 'technician')
        ->get();

    return view('user.maintenance-tasks.create', compact('machines', 'technicians'));
}

  public function store(Request $request)
{
    $validated = $request->validate([
        'machine_id' => 'required|exists:machines,id',
        'assigned_to' => 'nullable|exists:users,id',
        'scheduled_at' => 'required|date',
        'notes' => 'nullable|string',
        'cost_estimate' => 'nullable|numeric|min:0',

        'parts' => 'nullable|array',
        'parts.*.name' => 'nullable|string',
        'parts.*.quantity' => 'nullable|integer|min:1',
        'parts.*.cost' => 'nullable|numeric|min:0',
    ]);

    $machine = Machine::findOrFail($validated['machine_id']);

    if ($machine->company_id !== Auth::user()->company_id) {
        abort(403);
    }

    $validated['company_id'] = Auth::user()->company_id;
    $validated['created_by'] = Auth::id();
    $validated['status'] = 'scheduled';

    // Convert parts array to JSON
    if ($request->parts) {
        $validated['parts_required'] = json_encode($request->parts);
    }

    MaintenanceTask::create($validated);

    return redirect()->route('user.maintenance-tasks.index')
        ->with('success', 'Maintenance task created successfully');
}

    public function edit($id)
    {

        $task = MaintenanceTask::with(['machine', 'createdBy', 'assignedTo'])
            ->where('company_id', Auth::user()->company_id)
            ->findOrFail($id);

        if ($task->company_id !== Auth::user()->company_id) {
            abort(403);
        }

        $machines = Machine::where('company_id', Auth::user()->company_id)->get();
        $technicians = User::where('role', 'technician')
            ->get();
        return view('user.maintenance-tasks.edit', compact('task', 'machines', 'technicians'));
    }

 public function update(Request $request, $id)
{
    $task = MaintenanceTask::where('company_id', Auth::user()->company_id)
        ->findOrFail($id);

    if ($task->company_id !== Auth::user()->company_id) {
        abort(403);
    }

    $validated = $request->validate([
        'machine_id' => 'required|exists:machines,id',
        'assigned_to' => 'nullable|exists:users,id',
        'scheduled_at' => 'required|date',
        'status' => 'required|in:scheduled,in_progress,completed,cancelled',
        'completed_at' => 'nullable|date|required_if:status,completed',
        'notes' => 'nullable|string',
        'cost_estimate' => 'nullable|numeric|min:0',

        // parts validation
        'parts' => 'nullable|array',
        'parts.*.name' => 'nullable|string',
        'parts.*.quantity' => 'nullable|integer|min:1',
        'parts.*.cost' => 'nullable|numeric|min:0',
    ]);

    // Verify machine belongs to same company
    $machine = Machine::findOrFail($validated['machine_id']);
    if ($machine->company_id !== Auth::user()->company_id) {
        abort(403);
    }

    // Convert parts array to JSON
    if ($request->parts) {
        $validated['parts_required'] = json_encode($request->parts);
    } else {
        $validated['parts_required'] = null;
    }

    $task->update($validated);

    return redirect()->route('user.maintenance-tasks.index')
        ->with('success', 'Maintenance task updated successfully');
}

    public function destroy($id)
    {
         $task = MaintenanceTask::with(['machine', 'createdBy', 'assignedTo'])
            ->where('company_id', Auth::user()->company_id)
            ->findOrFail($id);


        if ($task->company_id !== Auth::user()->company_id) {
            abort(403);
        }

        $task->delete();

        return redirect()->route('user.maintenance-tasks.index')
            ->with('success', 'Maintenance task deleted successfully');
    }
}