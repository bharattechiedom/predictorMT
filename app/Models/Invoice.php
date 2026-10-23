<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;

    protected $fillable = [
        'company_id',
        'amount',
        'billing_period_start',
        'billing_period_end',
        'paid_at',
        'status',
        'external_invoice_id'
    ];

    protected $casts = [
        'amount' => 'decimal:2',
        'billing_period_start' => 'date',
        'billing_period_end' => 'date',
        'paid_at' => 'datetime'
    ];

    // Relationships
    public function company()
    {
        return $this->belongsTo(Company::class);
    }
}
