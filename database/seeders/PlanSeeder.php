<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Plan;

class PlanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        if (Plan::count() === 0) {
            Plan::create([
                'name' => 'Basic Plan',
                'price' => 299.00,
                'machines_included' => 1,
                'billing_interval' => 'per machine / month',
                'description' => 'Entry-level plan suitable for small setups.',
                'features' => [
                    '30h Fast generations',
                    'Unlimited Relaxed generations',
                    'General commercial terms',
                    'Access to member dashboard',
                    'Optional credit top ups',
                    'Setup fees, sensor costs, and dashboard access'
                ]
            ]);
        }
    }
}
