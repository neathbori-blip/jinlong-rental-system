<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tenant extends Model
{
    protected $fillable = [
        'name', 'email', 'phone', 'property_id', 'unit_number',
        'monthly_rent', 'lease_end', 'status', 'move_in_date'
    ];

    protected $casts = [
        'lease_end' => 'date',
        'move_in_date' => 'date',
    ];

    public function property()
    {
        return $this->belongsTo(Property::class);
    }

    public function getFormattedRentAttribute()
    {
        return '$' . number_format($this->monthly_rent, 2);
    }

    public function leases()
{
    return $this->hasMany(Lease::class);
}
}