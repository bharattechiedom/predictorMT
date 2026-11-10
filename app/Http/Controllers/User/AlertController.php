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
        $companyId = Auth::user()->company_id;
        $query = Alert::where('company_id', $companyId)
            ->with('machine', 'sensor', 'acknowledgedBy');

        if (request()->filled('search')) {
            $search = request()->input('search');
            $query->where(function ($alertQuery) use ($search) {
                $alertQuery->where('message', 'like', '%'.$search.'%')
                    ->orWhere('id', $search);
            });
        }
        if (request()->filled('date')) {
            $query->whereDate('created_at', request()->input('date'));
        }
        if (request()->filled('severity')) {
            $query->where('level', request()->input('severity'));
        }

        $alerts = $query
            ->latest()
            ->paginate(15)
            ->withQueryString();
        $severityCounts = Alert::where('company_id', $companyId)
            ->whereNull('acknowledged_at')
            ->selectRaw('level, COUNT(*) as count')
            ->groupBy('level')
            ->pluck('count', 'level');

        return view('user.alert.index', compact('alerts', 'severityCounts'));
    }

    public function show(Alert $alert)
    {
        if ($alert->company_id !== Auth::user()->company_id) {
            abort(403);
        }

        return view('user.alert.show', compact('alert'));
    }

    public function acknowledge(Request $request, Alert $alert)
    {
        if ($alert->company_id !== Auth::user()->company_id) {
            abort(403);
        }
        $alert->update([
            'acknowledged_by' => Auth::id(),
            'acknowledged_at' => now(),
        ]);

        return redirect()->back()->with('success', 'Alert acknowledged');
    }

    public function destroy(Alert $alert)
    {
        if ($alert->company_id !== Auth::user()->company_id) {
            abort(403);
        }
        $alert->delete();

        return redirect()->route('user.alerts.index')->with('success', 'Alert deleted');
    }
}
