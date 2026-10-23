<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Subscription;
use App\Models\Company;
use App\Models\Plan;
use Illuminate\Http\Request;

class SubscriptionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $subscriptions = Subscription::with(['company','plan'])->latest()->paginate(15);
        return view('admin.subscriptions.index', compact('subscriptions'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $companies = Company::orderBy('name')->get(['id','name']);
        $plans = Plan::orderBy('name')->get(['id','name']);
        return view('admin.subscriptions.create', compact('companies','plans'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'company_id' => 'required|exists:companies,id',
            'plan_id' => 'required|exists:plans,id',
            'status' => 'required|in:active,trialing,past_due,cancelled',
            'started_at' => 'required|date',
            'ended_at' => 'nullable|date',
            'external_subscription_id' => 'nullable|string|max:255',
        ]);

        $subscription = Subscription::create($validated);
        return redirect()->route('admin.subscriptions.show', $subscription)->with('success', 'Subscription created.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Subscription $subscription)
    {
        $subscription->load(['company','plan']);
        return view('admin.subscriptions.show', compact('subscription'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Subscription $subscription)
    {
        $companies = Company::orderBy('name')->get(['id','name']);
        $plans = Plan::orderBy('name')->get(['id','name']);
        return view('admin.subscriptions.edit', compact('subscription','companies','plans'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Subscription $subscription)
    {
        $validated = $request->validate([
            'company_id' => 'required|exists:companies,id',
            'plan_id' => 'required|exists:plans,id',
            'status' => 'required|in:active,trialing,past_due,cancelled',
            'started_at' => 'required|date',
            'ended_at' => 'nullable|date',
            'external_subscription_id' => 'nullable|string|max:255',
        ]);

        $subscription->update($validated);
        return redirect()->route('admin.subscriptions.show', $subscription)->with('success', 'Subscription updated.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Subscription $subscription)
    {
        $subscription->delete();
        return redirect()->route('admin.subscriptions.index')->with('success', 'Subscription deleted.');
    }
}
