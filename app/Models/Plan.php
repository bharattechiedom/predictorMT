<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Plan extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'price',
        'machines_included',
        'billing_interval',
        'description',
        'features'
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'machines_included' => 'integer',
        'features' => 'array',
    ];

    // Relationships
    public function companies()
    {
        return $this->hasMany(Company::class);
    }

    public function subscriptions()
    {
        return $this->hasMany(Subscription::class);
    }
}
