<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Alert;
use App\Models\Invoice;
use App\Models\Machine;
use App\Models\Sensor;
use App\Models\SensorReading;
use App\Models\Subscription;
use Illuminate\Support\Facades\Auth;

class BillingController extends Controller
{
    public function index()
    {
        $companyId = Auth::user()->company_id;
        $invoices = Invoice::where('company_id', $companyId)
            ->latest()
            ->paginate(15);

        $subscription = Subscription::with('plan')->where('company_id', $companyId)->latest()->first();
        $usage = [
            'machines' => Machine::where('company_id', $companyId)->count(),
            'sensors' => Sensor::whereHas('machine', fn ($query) => $query->where('company_id', $companyId))->count(),
            'readings' => SensorReading::whereHas('machine', fn ($query) => $query->where('company_id', $companyId))
                ->where('timestamp', '>=', now()->startOfMonth())
                ->count(),
            'alerts' => Alert::where('company_id', $companyId)
                ->where('created_at', '>=', now()->startOfMonth())
                ->count(),
        ];

        return view('user.billing.index', compact('invoices', 'subscription', 'usage'));
    }

    public function show(Invoice $invoice)
    {
        if ($invoice->company_id !== Auth::user()->company_id) {
            abort(403);
        }

        return view('user.billing.show', compact('invoice'));
    }
}
