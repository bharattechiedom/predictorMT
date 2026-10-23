<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Alert extends Model
{
    use HasFactory;

    protected $fillable = [
        'company_id',
        'machine_id',
        'sensor_id',
        'level',
        'message',
        'origin',
        'payload',
        'acknowledged_by',
        'acknowledged_at'
    ];

    protected $casts = [
        'payload' => 'array',
        'acknowledged_at' => 'datetime'
    ];

    // Relationships
    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function machine()
    {
        return $this->belongsTo(Machine::class);
    }

    public function sensor()
    {
        return $this->belongsTo(Sensor::class);
    }

    public function acknowledgedBy()
    {
        return $this->belongsTo(User::class, 'acknowledged_by');
    }
}
