<?php
// app/Models/Tenant.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tenant extends Model
{
    use HasFactory;

    protected $fillable = [
        'full_name',
        'email',
        'phone',
        'unit',
        'status',
        'lease_start_date',
        'monthly_rent',
        'security_deposit',
        'address',
        'emergency_contact'
    ];

    protected $casts = [
        'lease_start_date' => 'date',
        'monthly_rent' => 'decimal:2',
        'security_deposit' => 'decimal:2'
    ];

    // Accessor for formatted monthly rent
    public function getFormattedMonthlyRentAttribute()
    {
        return '$' . number_format($this->monthly_rent, 2);
    }

    // Scope for active tenants
    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }

    // Scope for search
    public function scopeSearch($query, $term)
    {
        return $query->where('full_name', 'LIKE', "%{$term}%")
                     ->orWhere('email', 'LIKE', "%{$term}%")
                     ->orWhere('unit', 'LIKE', "%{$term}%");
    }
}