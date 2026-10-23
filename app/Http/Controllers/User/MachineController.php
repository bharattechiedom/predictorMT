<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Machine;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MachineController extends Controller
{
    public function index()
    {
        $companyId = Auth::user()->company_id;
        $machines = Machine::where('company_id', $companyId)->latest()->paginate(10);
        return view('user.machines.index', compact('machines'));
    }

    public function create()
    {
        return view('user.machines.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'machine_type' => 'nullable|string|max:255',
            'serial_number' => 'nullable|string|max:255',
            'location' => 'nullable|string|max:255',
            'installed_at' => 'nullable|date',
            'status' => 'nullable|string|max:50',
        ]);

        $validated['company_id'] = Auth::user()->company_id;

        $machine = Machine::create($validated);

        return redirect()->route('user.machines.index', $machine)->with('success', 'Machine created successfully.');
    }

    public function show(Machine $machine)
    {
        $this->authorizeAccess($machine);
        return view('user.machines.view', compact('machine'));
    }

    public function edit(Machine $machine)
    {
        $this->authorizeAccess($machine);
        return view('user.machines.edit', compact('machine'));
    }

    public function update(Request $request, Machine $machine)
    {
        $this->authorizeAccess($machine);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'machine_type' => 'nullable|string|max:255',
            'serial_number' => 'nullable|string|max:255',
            'location' => 'nullable|string|max:255',
            'installed_at' => 'nullable|date',
            'status' => 'nullable|string|max:50',
        ]);

        $machine->update($validated);

        return redirect()->route('user.machines.index', $machine)->with('success', 'Machine updated successfully.');
    }

    public function destroy(Machine $machine)
    {
        $this->authorizeAccess($machine);
        $machine->delete();
        return redirect()->route('user.machines.index')->with('success', 'Machine deleted successfully.');
    }

    private function authorizeAccess(Machine $machine): void
    {
        if ($machine->company_id !== Auth::user()->company_id) {
            abort(403);
        }
    }
}


