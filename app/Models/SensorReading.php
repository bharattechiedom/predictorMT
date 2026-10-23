<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SensorReading extends Model
{
    use HasFactory;

    protected $fillable = [
        'sensor_id',
        'machine_id',
        'timestamp',
        'payload',
        'value_float'
    ];

    protected $casts = [
        'timestamp' => 'datetime',
        'payload' => 'array',
        'value_float' => 'float'
    ];

    // Relationships
    public function sensor()
    {
        return $this->belongsTo(Sensor::class);
    }

    public function machine()
    {
        return $this->belongsTo(Machine::class);
    }
}
