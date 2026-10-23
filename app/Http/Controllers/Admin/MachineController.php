<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Machine;
use App\Models\Company;
use Illuminate\Http\Request;

class MachineController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $machines = Machine::with('company')->latest()->paginate(15);
        return view('admin.machines.index', compact('machines'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $companies = Company::orderBy('name')->get(['id','name']);
        return view('admin.machines.create', compact('companies'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'company_id' => 'required|exists:companies,id',
            'name' => 'required|string|max:255',
            'machine_type' => 'nullable|string|max:100',
            'serial_number' => 'nullable|string|max:100',
            'location' => 'nullable|string|max:255',
            'installed_at' => 'nullable|date',
            'status' => 'required|in:healthy,at_risk,critical,offline',
        ]);

        $machine = Machine::create($validated);

        return redirect()->route('admin.machines.show', $machine)->with('success', 'Machine created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Machine $machine)
    {
        $machine->load('company');
        return view('admin.machines.show', compact('machine'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Machine $machine)
    {
        $companies = Company::orderBy('name')->get(['id','name']);
        return view('admin.machines.edit', compact('machine','companies'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Machine $machine)
    {
        $validated = $request->validate([
            'company_id' => 'required|exists:companies,id',
            'name' => 'required|string|max:255',
            'machine_type' => 'nullable|string|max:100',
            'serial_number' => 'nullable|string|max:100',
            'location' => 'nullable|string|max:255',
            'installed_at' => 'nullable|date',
            'status' => 'required|in:healthy,at_risk,critical,offline',
        ]);

        $machine->update($validated);

        return redirect()->route('admin.machines.show', $machine)->with('success', 'Machine updated.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Machine $machine)
    {
        $machine->delete();
        return redirect()->route('admin.machines.index')->with('success', 'Machine deleted.');
    }
}
