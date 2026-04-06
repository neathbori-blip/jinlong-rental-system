<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Property extends Model
{
    protected $fillable = [
        'name', 'address', 'city', 'state', 'zip_code'
    ];
    
    // Define relationship: A property has many units
    public function units(): HasMany
    {
        return $this->hasMany(Unit::class);
    }
}