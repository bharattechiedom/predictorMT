<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Machine;
use App\Models\Sensor;
use App\Models\Prediction;
use App\Models\MaintenanceTask;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReportController extends Controller
{
    public function index(Request $request)
    {
        $companyId = Auth::user()->company_id;

        $machinesCount = Machine::where('company_id', $companyId)->count();
        $sensorsCount = Sensor::whereHas('machine', function($q) use ($companyId) {
            $q->where('company_id', $companyId);
        })->count();

        $openPredictions = Prediction::whereHas('machine', function($q) use ($companyId) {
            $q->where('company_id', $companyId);
        })->whereIn('status', ['open','acknowledged'])->count();

        $upcomingTasks = MaintenanceTask::where('company_id', $companyId)
            ->where('scheduled_at', '>=', now())
            ->count();

        // Basic report payload
        $report = compact('machinesCount', 'sensorsCount', 'openPredictions', 'upcomingTasks');

        return view('user.reports.index', compact('report'));
    }
}
