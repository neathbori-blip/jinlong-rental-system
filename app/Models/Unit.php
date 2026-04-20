<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Unit extends Model
{
    protected $table = 'units';
    protected $primaryKey = 'id';
    protected $fillable = [
        'property_id',
        'unit_number',
        'bedrooms',
        'bathrooms',
        'square_feet',
        'monthly_rent',
        'security_deposit',
        'is_available'
    ];
    
    protected $casts = [
        'is_available' => 'boolean',
    ];
    
    // Relationships
    public function property()
    {
        return $this->belongsTo(Property::class, 'property_id');
    }
    
    public function leases()
    {
        return $this->hasMany(Lease::class, 'unit_id');
    }
    
    public function activeLease()
    {
        return $this->hasOne(Lease::class, 'unit_id')->where('status', 'active');
    }
    
    public function maintenanceRequests()
    {
        return $this->hasMany(MaintenanceRequest::class, 'unit_id');
    }
    

}