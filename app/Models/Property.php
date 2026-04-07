<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Property extends Model
{
    protected $table = 'properties';
    protected $primaryKey = 'id';
    protected $fillable = [
        'landlord_id',
        'name',
        'address_line1',
        'address_line2',
        'city',
        'state',
        'postal_code',
        'country',
        'property_type',
        'total_units'
    ];
    
    // Relationships
    public function landlord()
    {
        return $this->belongsTo(User::class, 'landlord_id');
    }
    
    public function units()
    {
        return $this->hasMany(Unit::class, 'property_id');
    }
    
    public function availableUnits()
    {
        return $this->hasMany(Unit::class, 'property_id')->where('is_available', true);
    }
}