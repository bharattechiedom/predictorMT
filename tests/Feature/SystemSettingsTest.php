<?php

namespace Tests\Feature;

use App\Models\Admin;
use App\Services\SystemSettings;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Schema;
use Tests\TestCase;

class SystemSettingsTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        Schema::create('admins', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password');
            $table->timestamps();
        });
    }

    public function test_admin_can_view_and_update_simulation_thresholds(): void
    {
        $admin = Admin::create([
            'name' => 'Test Admin',
            'email' => 'admin@example.test',
            'password' => 'password',
        ]);

        $this->actingAs($admin, 'admin')
            ->get(route('admin.settings.index'))
            ->assertOk()
            ->assertSee('System Configuration')
            ->assertSee('value="90"', false);

        $this->put(route('admin.settings.update'), [
            'simulation_defaults' => [
                'scenario' => 'bearing_failure',
                'speed' => 5,
            ],
            'thresholds' => [
                'temperature_max' => 95,
                'pressure_min' => 65,
                'humidity_max' => 75,
                'vibration_max' => 7.5,
            ],
        ])->assertRedirect(route('admin.settings.index'));

        $this->assertSame([
            'scenario' => 'bearing_failure',
            'speed' => 5,
        ], app(SystemSettings::class)->simulationDefaults());
        $this->assertSame([
            'temperature_max' => 95,
            'pressure_min' => 65,
            'humidity_max' => 75,
            'vibration_max' => 7.5,
        ], app(SystemSettings::class)->simulationThresholds());
    }

    public function test_admin_configuration_rejects_out_of_range_thresholds(): void
    {
        $admin = Admin::create([
            'name' => 'Test Admin',
            'email' => 'admin@example.test',
            'password' => 'password',
        ]);

        $this->actingAs($admin, 'admin')
            ->put(route('admin.settings.update'), [
                'simulation_defaults' => [
                    'scenario' => 'normal',
                    'speed' => 1,
                ],
                'thresholds' => [
                    'temperature_max' => 201,
                    'pressure_min' => 65,
                    'humidity_max' => 75,
                    'vibration_max' => 7.5,
                ],
            ])
            ->assertSessionHasErrors('thresholds.temperature_max');
    }

    public function test_simulation_thresholds_default_to_config_until_saved(): void
    {
        $this->assertSame(config('predictor.simulation.thresholds'), app(SystemSettings::class)->simulationThresholds());
    }

    public function test_simulation_defaults_use_config_until_saved(): void
    {
        $this->assertSame(config('predictor.simulation.defaults'), app(SystemSettings::class)->simulationDefaults());
    }
}
