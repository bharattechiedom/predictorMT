<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Company;
use App\Models\Plan;
use App\Models\User;
use App\Models\Machine;
use App\Models\Sensor;
use App\Models\Prediction;
use App\Models\Alert;
use App\Models\MaintenanceTask;
use App\Models\Subscription;
use App\Models\Invoice;
use App\Models\Ticket;
use Illuminate\Support\Facades\Hash;

class PredictorMTSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create Plans
        $basicPlan = Plan::create([
            'name' => 'Basic Plan',
            'price' => 99.99,
            'machines_included' => 5
        ]);

        $proPlan = Plan::create([
            'name' => 'Pro Plan',
            'price' => 199.99,
            'machines_included' => 20
        ]);

        $enterprisePlan = Plan::create([
            'name' => 'Enterprise Plan',
            'price' => 499.99,
            'machines_included' => 100
        ]);

        // Create Companies
        $companies = [
            [
                'name' => 'TechCorp Industries',
                'country' => 'United States',
                'timezone' => 'America/New_York',
                'plan_id' => $proPlan->id
            ],
            [
                'name' => 'Manufacturing Solutions Ltd',
                'country' => 'United Kingdom',
                'timezone' => 'Europe/London',
                'plan_id' => $basicPlan->id
            ],
            [
                'name' => 'Global Manufacturing Co',
                'country' => 'Germany',
                'timezone' => 'Europe/Berlin',
                'plan_id' => $enterprisePlan->id
            ],
            [
                'name' => 'Smart Factory Inc',
                'country' => 'Japan',
                'timezone' => 'Asia/Tokyo',
                'plan_id' => $proPlan->id
            ],
            [
                'name' => 'Industrial Systems AB',
                'country' => 'Sweden',
                'timezone' => 'Europe/Stockholm',
                'plan_id' => $basicPlan->id
            ]
        ];

        foreach ($companies as $companyData) {
            $company = Company::create($companyData);

            // Create users for each company
            User::create([
                'company_id' => $company->id,
                'name' => 'Admin User',
                'email' => 'admin@' . strtolower(str_replace(' ', '', $company->name)) . '.com',
                'password' => Hash::make('password123'),
                'phone' => '+1-555-0123',
                'role' => 'admin'
            ]);

            User::create([
                'company_id' => $company->id,
                'name' => 'Manager User',
                'email' => 'manager@' . strtolower(str_replace(' ', '', $company->name)) . '.com',
                'password' => Hash::make('password123'),
                'phone' => '+1-555-0124',
                'role' => 'manager'
            ]);

            // Create machines for each company
            $machineTypes = ['Conveyor Belt', 'Pump System', 'Motor Assembly', 'Press Machine', 'Welding Station'];
            $statuses = ['healthy', 'at_risk', 'critical', 'offline'];
            
            for ($i = 1; $i <= rand(3, 8); $i++) {
                Machine::create([
                    'company_id' => $company->id,
                    'name' => $machineTypes[array_rand($machineTypes)] . ' #' . $i,
                    'machine_type' => $machineTypes[array_rand($machineTypes)],
                    'serial_number' => 'SN' . rand(100000, 999999),
                    'location' => 'Building ' . chr(65 + rand(0, 5)) . ', Floor ' . rand(1, 3),
                    'installed_at' => now()->subDays(rand(30, 365)),
                    'status' => $statuses[array_rand($statuses)]
                ]);
            }

            // Create sensors for some machines
            $machines = $company->machines;
            foreach ($machines->take(3) as $machine) {
                Sensor::create([
                    'device_id' => 'SENSOR_' . rand(1000, 9999),
                    'machine_id' => $machine->id,
                    'sensor_type' => 'Temperature',
                    'firmware_version' => 'v' . rand(1, 3) . '.' . rand(0, 9),
                    'battery_level' => rand(20, 100),
                    'last_seen' => now()->subHours(rand(1, 24)),
                    'status' => 'active'
                ]);

                Sensor::create([
                    'device_id' => 'SENSOR_' . rand(1000, 9999),
                    'machine_id' => $machine->id,
                    'sensor_type' => 'Vibration',
                    'firmware_version' => 'v' . rand(1, 3) . '.' . rand(0, 9),
                    'battery_level' => rand(20, 100),
                    'last_seen' => now()->subHours(rand(1, 24)),
                    'status' => 'active'
                ]);
            }

            // Create some predictions
            foreach ($machines->take(2) as $machine) {
                $sensor = $machine->sensors()->first();
                Prediction::create([
                    'machine_id' => $machine->id,
                    'sensor_id' => $sensor?->id,
                    'predicted_at' => now(),
                    'predicted_failure_at' => now()->addDays(rand(1, 30)),
                    'probability' => rand(50, 95) / 100,
                    'component' => 'Bearing',
                    'model_version' => 'v2.1',
                    'status' => 'open'
                ]);
            }

            // Create some alerts
            foreach ($machines->take(2) as $machine) {
                $sensor = $machine->sensors()->first();
                Alert::create([
                    'company_id' => $company->id,
                    'machine_id' => $machine->id,
                    'sensor_id' => $sensor?->id,
                    'level' => ['info', 'warning', 'critical'][array_rand(['info', 'warning', 'critical'])],
                    'message' => 'Temperature threshold exceeded on ' . $machine->name,
                    'origin' => 'sensor'
                ]);
            }

            // Create maintenance tasks
            foreach ($machines->take(2) as $machine) {
                MaintenanceTask::create([
                    'company_id' => $company->id,
                    'machine_id' => $machine->id,
                    'created_by' => $company->users->first()->id,
                    'assigned_to' => $company->users->skip(1)->first()?->id,
                    'scheduled_at' => now()->addDays(rand(1, 7)),
                    'status' => 'scheduled',
                    'notes' => 'Regular maintenance check for ' . $machine->name,
                    'cost_estimate' => rand(100, 1000)
                ]);
            }

            // Create subscription
            Subscription::create([
                'company_id' => $company->id,
                'plan_id' => $company->plan_id,
                'status' => 'active',
                'started_at' => now()->subMonths(rand(1, 12)),
                'external_subscription_id' => 'sub_' . rand(100000, 999999)
            ]);

            // Create invoice
            Invoice::create([
                'company_id' => $company->id,
                'amount' => $company->plan->price,
                'billing_period_start' => now()->subMonth(),
                'billing_period_end' => now(),
                'status' => 'paid',
                'paid_at' => now()->subDays(rand(1, 10))
            ]);

            // Create support tickets
            Ticket::create([
                'company_id' => $company->id,
                'user_id' => $company->users->first()->id,
                'subject' => 'Sensor connectivity issue',
                'description' => 'Having trouble with sensor data transmission',
                'status' => 'open',
                'priority' => 'medium'
            ]);
        }

        $this->command->info('PredictorMT sample data created successfully!');
    }
}
