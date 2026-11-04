<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\SensorDataGenerator;
use App\Services\SystemSettings;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function index(SystemSettings $systemSettings)
    {
        return view('admin.system-settings', [
            'admin' => auth('admin')->user(),
            'simulationDefaults' => $systemSettings->simulationDefaults(),
            'scenarios' => SensorDataGenerator::SCENARIOS,
            'thresholds' => $systemSettings->simulationThresholds(),
            'mqttEnabled' => config('mqtt.enabled'),
            'mqttConfiguration' => [
                'host' => config('mqtt.host'),
                'port' => config('mqtt.port'),
                'use_tls' => config('mqtt.use_tls'),
                'publish_topic' => config('mqtt.publish_topic'),
                'subscribe_topic' => config('mqtt.subscribe_topic'),
            ],
        ]);
    }

    public function update(Request $request, SystemSettings $systemSettings)
    {
        $validated = $request->validate([
            'simulation_defaults.scenario' => ['required', 'string', 'in:'.implode(',', array_keys(SensorDataGenerator::SCENARIOS))],
            'simulation_defaults.speed' => ['required', 'integer', 'in:1,2,5,10,20'],
            'thresholds.temperature_max' => ['required', 'numeric', 'between:30,200'],
            'thresholds.pressure_min' => ['required', 'numeric', 'between:0,500'],
            'thresholds.humidity_max' => ['required', 'numeric', 'between:0,100'],
            'thresholds.vibration_max' => ['required', 'numeric', 'between:0,100'],
        ]);

        $systemSettings->saveSimulationDefaults($validated['simulation_defaults']);
        $systemSettings->saveSimulationThresholds($validated['thresholds']);

        return redirect()
            ->route('admin.settings.index')
            ->with('success', 'Simulation and alert settings were saved.');
    }
}
