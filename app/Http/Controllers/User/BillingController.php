<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Invoice;
use App\Models\Subscription;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BillingController extends Controller
{
    public function index()
    {
        $invoices = Invoice::where('company_id', Auth::user()->company_id)
            ->latest()
            ->paginate(15);

        $subscription = Subscription::where('company_id', Auth::user()->company_id)->latest()->first();

        return view('user.billing.index', compact('invoices', 'subscription'));
    }

    public function show(Invoice $invoice)
    {
        if ($invoice->company_id !== Auth::user()->company_id) abort(403);
        return view('user.billing.show', compact('invoice'));
    }
}
