<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Machine extends Model
{
    use HasFactory;

    protected $fillable = [
        'company_id',
        'name',
        'machine_type',
        'serial_number',
        'location',
        'installed_at',
        'status',
        'metadata'
    ];

    protected $casts = [
        'installed_at' => 'date',
        'metadata' => 'array'
    ];

    // Relationships
    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function sensors()
    {
        return $this->hasMany(Sensor::class);
    }

    public function sensorReadings()
    {
        return $this->hasMany(SensorReading::class);
    }

    public function predictions()
    {
        return $this->hasMany(Prediction::class);
    }

    public function maintenanceTasks()
    {
        return $this->hasMany(MaintenanceTask::class);
    }

    public function alerts()
    {
        return $this->hasMany(Alert::class);
    }
}
