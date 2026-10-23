<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Create plans table first (no dependencies)
        Schema::create('plans', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->decimal('price', 10, 2);
            $table->integer('machines_included');
            $table->timestamps();
        });

        // Create companies table
        Schema::create('companies', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('country')->nullable();
            $table->string('timezone')->default('UTC');
            $table->unsignedBigInteger('plan_id')->nullable();
            $table->timestamps();
        });

        // Update users table to add company_id and role
        Schema::table('users', function (Blueprint $table) {
            $table->unsignedBigInteger('company_id')->nullable()->after('id');
            $table->string('phone')->nullable()->after('password');
            $table->enum('role', ['superadmin','admin','manager','technician','viewer'])->default('viewer')->after('phone');
        });

        // Create machines table
        Schema::create('machines', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('company_id');
            $table->string('name');
            $table->string('machine_type');
            $table->string('serial_number')->nullable();
            $table->string('location')->nullable();
            $table->date('installed_at')->nullable();
            $table->enum('status', ['healthy','at_risk','critical','offline'])->default('healthy');
            $table->json('metadata')->nullable();
            $table->timestamps();
            
            $table->foreign('company_id')->references('id')->on('companies')->onDelete('cascade');
        });

        // Create sensors table
        Schema::create('sensors', function (Blueprint $table) {
            $table->id();
            $table->string('device_id')->unique();
            $table->unsignedBigInteger('machine_id')->nullable();
            $table->string('sensor_type');
            $table->string('firmware_version')->nullable();
            $table->integer('battery_level')->nullable();
            $table->datetime('last_seen')->nullable();
            $table->enum('status', ['active','inactive','faulty','provisioning'])->default('active');
            $table->timestamps();
            
            $table->foreign('machine_id')->references('id')->on('machines')->onDelete('set null');
        });

        // Create sensor_readings table
        Schema::create('sensor_readings', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('sensor_id');
            $table->unsignedBigInteger('machine_id');
            $table->datetime('timestamp');
            $table->json('payload')->nullable();
            $table->double('value_float')->nullable();
            $table->timestamp('created_at')->nullable();
            
            $table->foreign('sensor_id')->references('id')->on('sensors')->onDelete('cascade');
            $table->foreign('machine_id')->references('id')->on('machines')->onDelete('cascade');
            $table->index('timestamp');
        });

        // Create predictions table
        Schema::create('predictions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('machine_id');
            $table->unsignedBigInteger('sensor_id')->nullable();
            $table->datetime('predicted_at');
            $table->datetime('predicted_failure_at')->nullable();
            $table->decimal('probability', 5, 4);
            $table->string('component')->nullable();
            $table->string('model_version');
            $table->json('explanation')->nullable();
            $table->enum('status', ['open','acknowledged','converted','resolved'])->default('open');
            $table->timestamps();
            
            $table->foreign('machine_id')->references('id')->on('machines')->onDelete('cascade');
            $table->foreign('sensor_id')->references('id')->on('sensors')->onDelete('set null');
        });

        // Create maintenance_tasks table
        Schema::create('maintenance_tasks', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('company_id');
            $table->unsignedBigInteger('machine_id');
            $table->unsignedBigInteger('created_by');
            $table->unsignedBigInteger('assigned_to')->nullable();
            $table->datetime('scheduled_at')->nullable();
            $table->datetime('completed_at')->nullable();
            $table->enum('status', ['scheduled','in_progress','completed','cancelled'])->default('scheduled');
            $table->text('notes')->nullable();
            $table->json('parts_required')->nullable();
            $table->decimal('cost_estimate', 10, 2)->nullable();
            $table->timestamps();
            
            $table->foreign('company_id')->references('id')->on('companies')->onDelete('cascade');
            $table->foreign('machine_id')->references('id')->on('machines')->onDelete('cascade');
            $table->foreign('created_by')->references('id')->on('users');
            $table->foreign('assigned_to')->references('id')->on('users');
        });

        // Create alerts table
        Schema::create('alerts', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('company_id');
            $table->unsignedBigInteger('machine_id');
            $table->unsignedBigInteger('sensor_id')->nullable();
            $table->enum('level', ['info','warning','critical'])->default('info');
            $table->string('message', 500);
            $table->enum('origin', ['rule','prediction','manual','sensor'])->default('sensor');
            $table->json('payload')->nullable();
            $table->unsignedBigInteger('acknowledged_by')->nullable();
            $table->datetime('acknowledged_at')->nullable();
            $table->timestamps();
            
            $table->foreign('company_id')->references('id')->on('companies')->onDelete('cascade');
            $table->foreign('machine_id')->references('id')->on('machines')->onDelete('cascade');
            $table->foreign('sensor_id')->references('id')->on('sensors')->onDelete('set null');
            $table->foreign('acknowledged_by')->references('id')->on('users');
        });

        // Create subscriptions table
        Schema::create('subscriptions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('company_id');
            $table->unsignedBigInteger('plan_id');
            $table->enum('status', ['active','trialing','past_due','cancelled'])->default('trialing');
            $table->datetime('started_at')->nullable();
            $table->datetime('ended_at')->nullable();
            $table->string('external_subscription_id')->nullable();
            $table->timestamps();
            
            $table->foreign('company_id')->references('id')->on('companies')->onDelete('cascade');
            $table->foreign('plan_id')->references('id')->on('plans');
        });

        // Create invoices table
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('company_id');
            $table->decimal('amount', 10, 2);
            $table->date('billing_period_start');
            $table->date('billing_period_end');
            $table->datetime('paid_at')->nullable();
            $table->enum('status', ['pending','paid','failed'])->default('pending');
            $table->string('external_invoice_id')->nullable();
            $table->timestamps();
            
            $table->foreign('company_id')->references('id')->on('companies')->onDelete('cascade');
        });

        // Create tickets table
        Schema::create('tickets', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('company_id');
            $table->unsignedBigInteger('user_id');
            $table->string('subject');
            $table->text('description');
            $table->enum('status', ['open','pending','resolved','closed'])->default('open');
            $table->enum('priority', ['low','medium','high'])->default('medium');
            $table->timestamps();
            
            $table->foreign('company_id')->references('id')->on('companies')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tickets');
        Schema::dropIfExists('invoices');
        Schema::dropIfExists('subscriptions');
        Schema::dropIfExists('alerts');
        Schema::dropIfExists('maintenance_tasks');
        Schema::dropIfExists('predictions');
        Schema::dropIfExists('sensor_readings');
        Schema::dropIfExists('sensors');
        Schema::dropIfExists('machines');
        Schema::dropIfExists('companies');
        Schema::dropIfExists('plans');
        
        // Remove added columns from users table
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['company_id', 'phone', 'role']);
        });
    }
};
