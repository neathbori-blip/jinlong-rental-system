<?php
// app/Models/Tenant.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tenant extends Model
{
    use HasFactory;

    protected $table = 'tenants';
    
    // Fields that can be filled mass-assignment
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
        'emergency_contact',
        'notes'
    ];

    // Date casting
    protected $casts = [
        'lease_start_date' => 'date',
        'monthly_rent' => 'decimal:2',
        'security_deposit' => 'decimal:2',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    // Get active tenants
    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }

    // Get inactive tenants
    public function scopeInactive($query)
    {
        return $query->where('status', 'inactive');
    }

    // Search tenants
    public function scopeSearch($query, $term)
    {
        return $query->where('full_name', 'like', "%{$term}%")
                     ->orWhere('email', 'like', "%{$term}%")
                     ->orWhere('unit', 'like', "%{$term}%");
    }
}