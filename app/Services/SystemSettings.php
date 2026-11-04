<?php

namespace App\Services;

use App\Models\ApplicationSetting;

class SystemSettings
{
    public function simulationDefaults(): array
    {
        $setting = ApplicationSetting::query()->where('name', 'simulation.defaults')->first();

        return array_merge(config('predictor.simulation.defaults'), $setting?->value ?? []);
    }

    public function saveSimulationDefaults(array $defaults): void
    {
        ApplicationSetting::query()->updateOrCreate(
            ['name' => 'simulation.defaults'],
            ['value' => $defaults]
        );
    }

    public function simulationThresholds(): array
    {
        $setting = ApplicationSetting::query()->where('name', 'simulation.thresholds')->first();

        return array_merge(config('predictor.simulation.thresholds'), $setting?->value ?? []);
    }

    public function saveSimulationThresholds(array $thresholds): void
    {
        ApplicationSetting::query()->updateOrCreate(
            ['name' => 'simulation.thresholds'],
            ['value' => $thresholds]
        );
    }
}
