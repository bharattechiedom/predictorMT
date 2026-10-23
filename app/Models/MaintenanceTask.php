<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MaintenanceTask extends Model
{
    use HasFactory;

    protected $fillable = [
        'company_id',
        'machine_id',
        'created_by',
        'assigned_to',
        'scheduled_at',
        'completed_at',
        'status',
        'notes',
        'parts_required',
        'cost_estimate'
    ];

    protected $casts = [
        'scheduled_at' => 'datetime',
        'completed_at' => 'datetime',
        'parts_required' => 'array',
        'cost_estimate' => 'decimal:2'
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

    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function assignedTo()
    {
        return $this->belongsTo(User::class, 'assigned_to');
    }
}
