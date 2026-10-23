<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Alert;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AlertController extends Controller
{
    public function index()
    {
        $alerts = Alert::where('company_id', Auth::user()->company_id)
            ->with('machine', 'sensor', 'acknowledgedBy')
            ->latest()
            ->paginate(15);

        return view('user.alert.index', compact('alerts'));
    }

    public function show(Alert $alert)
    {
        if ($alert->company_id !== Auth::user()->company_id) abort(403);
        return view('user.alert.show', compact('alert'));
    }

    public function acknowledge(Request $request, Alert $alert)
    {
        if ($alert->company_id !== Auth::user()->company_id) abort(403);
        $alert->update([
            'acknowledged_by' => Auth::id(),
            'acknowledged_at' => now(),
        ]);
        return redirect()->back()->with('success', 'Alert acknowledged');
    }

    public function destroy(Alert $alert)
    {
        if ($alert->company_id !== Auth::user()->company_id) abort(403);
        $alert->delete();
        return redirect()->route('user.alerts.index')->with('success', 'Alert deleted');
    }
}
