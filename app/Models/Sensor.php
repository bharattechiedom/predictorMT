<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sensor extends Model
{
    use HasFactory;

    protected $fillable = [
        'device_id',
        'machine_id',
        'sensor_type',
        'firmware_version',
        'battery_level',
        'last_seen',
        'status'
    ];

    protected $casts = [
        'last_seen' => 'datetime',
        'battery_level' => 'integer'
    ];

    // Relationships
    public function machine()
    {
        return $this->belongsTo(Machine::class);
    }

    public function sensorReadings()
    {
        return $this->hasMany(SensorReading::class);
    }

    public function predictions()
    {
        return $this->hasMany(Prediction::class);
    }

    public function alerts()
    {
        return $this->hasMany(Alert::class);
    }
}
