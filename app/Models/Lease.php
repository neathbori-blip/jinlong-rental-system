<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Lease extends Model
{
    protected $table = 'leases';
    protected $primaryKey = 'id';
    protected $fillable = [
        'unit_id',
        'tenant_id',
        'start_date',
        'end_date',
        'monthly_rent',
        'security_deposit_paid',
        'status',
        'signed_by_tenant',
        'signed_by_landlord'
    ];
    
    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
        'signed_by_tenant' => 'boolean',
        'signed_by_landlord' => 'boolean',
    ];
    
    // Relationships
    public function unit()
    {
        return $this->belongsTo(Unit::class, 'unit_id');
    }
    
    public function tenant()
    {
        return $this->belongsTo(Tenant::class, 'tenant_id');
    }
    
    public function payments()
    {
        return $this->hasMany(Payment::class, 'lease_id');
    }
    
    // Helper method
    public function isActive()
    {
        return $this->status === 'active' && 
               now()->between($this->start_date, $this->end_date);
    }
}