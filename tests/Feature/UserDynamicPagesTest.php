<?php

namespace Tests\Feature;

use App\Models\Alert;
use App\Models\Company;
use App\Models\Machine;
use App\Models\MaintenanceTask;
use App\Models\Prediction;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserDynamicPagesTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_dashboard_pages_render_company_data_without_demo_rows(): void
    {
        $company = Company::create(['name' => 'Dynamic Test Company']);
        $user = User::create([
            'company_id' => $company->id,
            'name' => 'Dynamic Test User',
            'email' => 'dynamic-test@example.test',
            'password' => 'password',
            'role' => 'viewer',
        ]);
        $machine = Machine::create([
            'company_id' => $company->id,
            'name' => 'Dynamic Motor',
            'machine_type' => 'Motor',
            'serial_number' => 'DYNAMIC-001',
            'location' => 'Test Floor',
            'status' => 'healthy',
        ]);
        MaintenanceTask::create([
            'company_id' => $company->id,
            'machine_id' => $machine->id,
            'created_by' => $user->id,
            'scheduled_at' => now()->addDay(),
            'status' => 'scheduled',
            'notes' => 'Test maintenance item',
        ]);
        Prediction::create([
            'machine_id' => $machine->id,
            'predicted_at' => now(),
            'predicted_failure_at' => now()->addDays(3),
            'probability' => 0.8,
            'component' => 'Test bearing',
            'model_version' => 'test-model',
            'status' => 'open',
            'explanation' => ['reason' => 'Test explanation'],
        ]);
        Alert::create([
            'company_id' => $company->id,
            'machine_id' => $machine->id,
            'level' => 'critical',
            'message' => 'Test temperature alert',
            'origin' => 'manual',
        ]);

        $this->actingAs($user)
            ->get(route('user.dashboard'))
            ->assertOk()
            ->assertSee('Dynamic Motor')
            ->assertSee('DYNAMIC-001')
            ->assertSee('Test temperature alert');

        $this->get(route('user.maintenance-tasks.index'))
            ->assertOk()
            ->assertSee('Test temperature alert')
            ->assertSee('Test maintenance item');

        $this->get(route('user.predictions.index'))
            ->assertOk()
            ->assertSee('Dynamic Motor')
            ->assertSee('80.0%')
            ->assertSee('test-model');

        $this->get(route('user.team.index'))
            ->assertOk()
            ->assertSee('Dynamic Test User')
            ->assertDontSee('Priya Verma');

        $this->get(route('user.billing.index'))->assertOk();

        $this->get(route('user.support.index'))
            ->assertOk()
            ->assertSee('No tickets found.');

        $this->get(route('user.alerts.index'))
            ->assertOk()
            ->assertSee('Test temperature alert')
            ->assertSee('1 active issues');
    }

    public function test_maintenance_task_filters_are_applied_with_company_scope(): void
    {
        $company = Company::create(['name' => 'Filter Test Company']);
        $user = User::create([
            'company_id' => $company->id,
            'name' => 'Filter User',
            'email' => 'filter-test@example.test',
            'password' => 'password',
            'role' => 'viewer',
        ]);
        $machine = Machine::create([
            'company_id' => $company->id,
            'name' => 'Filter Motor',
            'machine_type' => 'Motor',
            'status' => 'healthy',
        ]);
        $task = MaintenanceTask::create([
            'company_id' => $company->id,
            'machine_id' => $machine->id,
            'created_by' => $user->id,
            'scheduled_at' => '2025-01-15 10:00:00',
            'status' => 'scheduled',
            'notes' => 'Matching task',
        ]);

        $this->actingAs($user)
            ->get(route('user.maintenance-tasks.index', [
                'status' => 'scheduled',
                'machine_id' => $machine->id,
                'date' => '2025-01-15',
            ]))
            ->assertOk()
            ->assertSee('Matching task')
            ->assertSee('Filter Motor');

        $this->get(route('user.maintenance-tasks.index', ['status' => 'completed']))
            ->assertOk()
            ->assertViewHas('tasks', fn ($tasks) => $tasks->total() === 0);
    }
}
