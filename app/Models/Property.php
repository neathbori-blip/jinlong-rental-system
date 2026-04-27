<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Property extends Model
{
    protected $fillable = [
        'name', 'address', 'total_units', 'occupied_units', 'monthly_revenue'
    ];

    public function leases()
{
    return $this->hasMany(Lease::class);
}
}