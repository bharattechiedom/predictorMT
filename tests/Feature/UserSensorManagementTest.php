<?php

namespace Tests\Feature;

use App\Models\Company;
use App\Models\Machine;
use App\Models\Sensor;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserSensorManagementTest extends TestCase
{
    use RefreshDatabase;

    public function test_sensor_creation_requires_a_company_machine_and_saves_valid_sensor(): void
    {
        [$user, $machine] = $this->createCompanyMachine();
        $this->actingAs($user);

        $this->from(route('user.sensors.create'))
            ->post(route('user.sensors.store'), $this->sensorData())
            ->assertRedirect(route('user.sensors.create'))
            ->assertSessionHasErrors('machine_id');

        $this->post(route('user.sensors.store'), $this->sensorData([
            'machine_id' => $machine->id,
        ]))->assertRedirect(route('user.sensors.index'));

        $this->assertDatabaseHas('sensors', [
            'device_id' => 'SENSOR-1',
            'machine_id' => $machine->id,
            'sensor_type' => 'temperature',
        ]);
    }

    public function test_sensor_creation_rejects_another_companys_machine(): void
    {
        [$user] = $this->createCompanyMachine();
        [, $otherMachine] = $this->createCompanyMachine('other-sensor@example.test');

        $this->actingAs($user)
            ->post(route('user.sensors.store'), $this->sensorData([
                'machine_id' => $otherMachine->id,
            ]))
            ->assertForbidden();

        $this->assertDatabaseMissing('sensors', ['device_id' => 'SENSOR-1']);
    }

    public function test_sensor_management_is_scoped_to_the_users_company(): void
    {
        [$user] = $this->createCompanyMachine();
        [, $otherMachine] = $this->createCompanyMachine('other-owner@example.test');
        $sensor = Sensor::create($this->sensorData(['machine_id' => $otherMachine->id]));

        $this->actingAs($user)
            ->get(route('user.sensors.show', $sensor))
            ->assertNotFound();

        $this->get(route('user.sensors.edit', $sensor))->assertNotFound();
        $this->put(route('user.sensors.update', $sensor), $this->sensorData([
            'device_id' => 'CHANGED-SENSOR',
            'machine_id' => $otherMachine->id,
        ]))->assertNotFound();
        $this->delete(route('user.sensors.destroy', $sensor))->assertNotFound();

        $this->assertDatabaseHas('sensors', [
            'id' => $sensor->id,
            'device_id' => 'SENSOR-1',
        ]);
    }

    public function test_sensor_can_be_viewed_updated_and_deleted_by_its_company(): void
    {
        [$user, $machine] = $this->createCompanyMachine();
        [, $otherMachine] = $this->createCompanyMachine('other-assignment@example.test');
        $sensor = Sensor::create($this->sensorData(['machine_id' => $machine->id]));

        $this->actingAs($user)
            ->get(route('user.sensors.show', $sensor))
            ->assertOk()
            ->assertSee('SENSOR-1');

        $this->put(route('user.sensors.update', $sensor), $this->sensorData([
            'device_id' => 'SENSOR-UPDATED',
            'machine_id' => $otherMachine->id,
        ]))->assertForbidden();

        $this->assertDatabaseHas('sensors', [
            'id' => $sensor->id,
            'machine_id' => $machine->id,
        ]);

        $this->put(route('user.sensors.update', $sensor), $this->sensorData([
            'device_id' => 'SENSOR-UPDATED',
            'machine_id' => $machine->id,
        ]))->assertRedirect(route('user.sensors.index'));

        $this->assertDatabaseHas('sensors', [
            'id' => $sensor->id,
            'device_id' => 'SENSOR-UPDATED',
        ]);

        $this->delete(route('user.sensors.destroy', $sensor))
            ->assertRedirect(route('user.sensors.index'));

        $this->assertDatabaseMissing('sensors', ['id' => $sensor->id]);
    }

    private function createCompanyMachine(string $email = 'sensor-owner@example.test'): array
    {
        $company = Company::create(['name' => 'Sensor Management Company']);
        $user = User::create([
            'company_id' => $company->id,
            'name' => 'Sensor User',
            'email' => $email,
            'password' => 'password',
            'role' => 'viewer',
        ]);
        $machine = Machine::create([
            'company_id' => $company->id,
            'name' => 'Sensor Test Machine',
            'machine_type' => 'Motor',
            'status' => 'healthy',
        ]);

        return [$user, $machine];
    }

    private function sensorData(array $overrides = []): array
    {
        return array_merge([
            'device_id' => 'SENSOR-1',
            'sensor_type' => 'temperature',
            'status' => 'active',
        ], $overrides);
    }
}
