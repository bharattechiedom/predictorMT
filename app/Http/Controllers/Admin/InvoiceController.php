<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Invoice;
use App\Models\Company;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $invoices = Invoice::with('company')->latest()->paginate(15);
        return view('admin.invoices.index', compact('invoices'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $companies = Company::orderBy('name')->get(['id','name']);
        return view('admin.invoices.create', compact('companies'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'company_id' => 'required|exists:companies,id',
            'amount' => 'required|numeric',
            'billing_period_start' => 'required|date',
            'billing_period_end' => 'required|date',
            'paid_at' => 'nullable|date',
            'status' => 'required|in:pending,paid,failed',
            'external_invoice_id' => 'nullable|string|max:255',
        ]);

        $invoice = Invoice::create($validated);
        return redirect()->route('admin.invoices.show', $invoice)->with('success', 'Invoice created.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Invoice $invoice)
    {
        $invoice->load('company');
        return view('admin.invoices.show', compact('invoice'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Invoice $invoice)
    {
        $companies = Company::orderBy('name')->get(['id','name']);
        return view('admin.invoices.edit', compact('invoice','companies'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Invoice $invoice)
    {
        $validated = $request->validate([
            'company_id' => 'required|exists:companies,id',
            'amount' => 'required|numeric',
            'billing_period_start' => 'required|date',
            'billing_period_end' => 'required|date',
            'paid_at' => 'nullable|date',
            'status' => 'required|in:pending,paid,failed',
            'external_invoice_id' => 'nullable|string|max:255',
        ]);

        $invoice->update($validated);
        return redirect()->route('admin.invoices.show', $invoice)->with('success', 'Invoice updated.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Invoice $invoice)
    {
        $invoice->delete();
        return redirect()->route('admin.invoices.index')->with('success', 'Invoice deleted.');
    }
}
