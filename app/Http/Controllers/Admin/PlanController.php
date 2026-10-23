<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Plan;
use Illuminate\Http\Request;

class PlanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $plans = Plan::paginate(15);
        return view('admin.plans.index', compact('plans'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.plans.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:100',
            'price' => 'required|numeric|min:0',
            'machines_included' => 'required|integer|min:1',
            'billing_interval' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'features_text' => 'nullable|string'
        ]);

        $data = $request->only(['name','price','machines_included','billing_interval','description']);
        // features_text is a textarea with one feature per line
        $features = array_filter(array_map('trim', explode("\n", $request->input('features_text', ''))));
        $data['features'] = $features ?: null;

        Plan::create($data);

        return redirect()->route('admin.plans.index')
            ->with('success', 'Plan created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Plan $plan)
    {
        return view('admin.plans.show', compact('plan'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Plan $plan)
    {
        return view('admin.plans.edit', compact('plan'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Plan $plan)
    {
        $request->validate([
            'name' => 'required|string|max:100',
            'price' => 'required|numeric|min:0',
            'machines_included' => 'required|integer|min:1',
            'billing_interval' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'features_text' => 'nullable|string'
        ]);

        $data = $request->only(['name','price','machines_included','billing_interval','description']);
        $features = array_filter(array_map('trim', explode("\n", $request->input('features_text', ''))));
        $data['features'] = $features ?: null;

        $plan->update($data);

        return redirect()->route('admin.plans.index')
            ->with('success', 'Plan updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Plan $plan)
    {
        $plan->delete();

        return redirect()->route('admin.plans.index')
            ->with('success', 'Plan deleted successfully.');
    }
}
