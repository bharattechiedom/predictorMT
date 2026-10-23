<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = [
        'stripe_session_id',
        'plan_id',
        'amount',
        'currency',
        'status',
        'customer_email',
        'raw_event'
    ];

    protected $casts = [
        'amount' => 'decimal:2',
    ];

    public function plan()
    {
        return $this->belongsTo(\App\Models\Plan::class);
    }
}
