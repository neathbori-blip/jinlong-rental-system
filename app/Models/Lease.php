<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Lease extends Model
{
    protected $fillable = [
        'tenant_id', 'property_id', 'unit_number', 'start_date', 'end_date',
        'monthly_rent', 'deposit_amount', 'status', 'notes'
    ];

    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
        'monthly_rent' => 'decimal:2',
        'deposit_amount' => 'decimal:2',
    ];

    public function tenant()
    {
        return $this->belongsTo(Tenant::class);
    }

    public function property()
    {
        return $this->belongsTo(Property::class);
    }

    public function getFormattedRentAttribute()
    {
        return '$' . number_format($this->monthly_rent, 2);
    }

    public function getFormattedDepositAttribute()
    {
        return '$' . number_format($this->deposit_amount, 2);
    }

    // Check if lease is expiring soon (within 30 days)
    public function getIsExpiringSoonAttribute()
    {
        $daysLeft = now()->diffInDays($this->end_date, false);
        return $daysLeft <= 30 && $daysLeft > 0;
    }

    // Get remaining days
    public function getDaysLeftAttribute()
    {
        $days = now()->diffInDays($this->end_date, false);
        return $days > 0 ? $days : 0;
    }

    
}