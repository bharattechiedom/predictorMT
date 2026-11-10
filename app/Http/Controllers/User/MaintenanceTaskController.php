<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Alert;
use App\Models\Machine;
use App\Models\MaintenanceTask;
use App\Models\Prediction;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MaintenanceTaskController extends Controller
{
    public function index(Request $request)
    {
        $companyId = Auth::user()->company_id;
        $taskQuery = MaintenanceTask::where('company_id', $companyId)
            ->with(['machine', 'createdBy', 'assignedTo']);

        if ($request->filled('search')) {
            $search = $request->input('search');
            $taskQuery->where(function ($query) use ($search) {
                $query->where('notes', 'like', '%'.$search.'%')
                    ->orWhereHas('machine', fn ($machineQuery) => $machineQuery->where('name', 'like', '%'.$search.'%'))
                    ->orWhereHas('assignedTo', fn ($userQuery) => $userQuery->where('name', 'like', '%'.$search.'%'));
            });
        }
        if ($request->filled('status')) {
            $taskQuery->where('status', $request->input('status'));
        }
        if ($request->filled('machine_id')) {
            $taskQuery->where('machine_id', $request->input('machine_id'));
        }
        if ($request->filled('date')) {
            $taskQuery->whereDate('scheduled_at', $request->input('date'));
        }

        $tasks = $taskQuery->latest()->paginate(10)->withQueryString();
        $machines = Machine::where('company_id', $companyId)->get();
        $activeAlerts = Alert::where('company_id', $companyId)
            ->whereNull('acknowledged_at')
            ->with('machine')
            ->latest()
            ->limit(5)
            ->get();
        $upcomingTasks = MaintenanceTask::where('company_id', $companyId)
            ->whereIn('status', ['scheduled', 'in_progress'])
            ->with(['machine', 'assignedTo'])
            ->orderBy('scheduled_at')
            ->limit(5)
            ->get();
        $completedTasks = MaintenanceTask::where('company_id', $companyId)
            ->where('status', 'completed')
            ->with(['machine', 'assignedTo'])
            ->latest('completed_at')
            ->limit(5)
            ->get();
        $recommendations = Prediction::whereHas('machine', fn ($query) => $query->where('company_id', $companyId))
            ->with('machine')
            ->whereIn('status', ['open', 'acknowledged'])
            ->orderByDesc('probability')
            ->limit(4)
            ->get();
        $faultCounts = Alert::where('company_id', $companyId)
            ->whereNull('acknowledged_at')
            ->selectRaw('level, COUNT(*) as count')
            ->groupBy('level')
            ->pluck('count', 'level');

        $stats = [
            'activeFaults' => Alert::where('company_id', $companyId)->whereNull('acknowledged_at')->count(),
            'criticalFaults' => Alert::where('company_id', $companyId)->whereNull('acknowledged_at')->where('level', 'critical')->count(),
            'scheduledTasks' => MaintenanceTask::where('company_id', $companyId)->where('status', 'scheduled')->count(),
            'resolvedTasks' => MaintenanceTask::where('company_id', $companyId)->where('status', 'completed')->count(),
            'machineHealth' => $machines->isEmpty() ? 0 : (int) round($machines->where('status', 'healthy')->count() / $machines->count() * 100),
        ];

        return view('user.maintenance-tasks.index', compact(
            'tasks', 'machines', 'activeAlerts', 'upcomingTasks', 'completedTasks', 'recommendations', 'faultCounts', 'stats'
        ));
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
