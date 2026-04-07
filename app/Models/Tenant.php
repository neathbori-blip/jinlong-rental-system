<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tenant extends Model
{
    protected $table = 'tenants';
    protected $primaryKey = 'id';
    protected $fillable = [
        'user_id',
        'date_of_birth',
        'emergency_contact_name',
        'emergency_contact_phone',
        'government_id'
    ];
    
    // Relationships
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    
    public function leases()
    {
        return $this->hasMany(Lease::class, 'tenant_id');
    }
    
    public function maintenanceRequests()
    {
        return $this->hasMany(MaintenanceRequest::class, 'tenant_id');
    }
    
    public function activeLease()
    {
        return $this->hasOne(Lease::class, 'tenant_id')->where('status', 'active');
    }
}