<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prediction extends Model
{
    use HasFactory;

    protected $fillable = [
        'machine_id',
        'sensor_id',
        'predicted_at',
        'predicted_failure_at',
        'probability',
        'component',
        'model_version',
        'explanation',
        'status'
    ];

    protected $casts = [
        'predicted_at' => 'datetime',
        'predicted_failure_at' => 'datetime',
        'probability' => 'decimal:4',
        'explanation' => 'array'
    ];

    // Relationships
    public function machine()
    {
        return $this->belongsTo(Machine::class);
    }

    public function sensor()
    {
        return $this->belongsTo(Sensor::class);
    }
}
