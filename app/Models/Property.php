<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Property extends Model
{
    protected $fillable = ['name', 'location', 'price', 'status', 'description', 'bedrooms', 'bathrooms'];
    
    public function tenant()
    {
        return $this->hasOne(Tenant::class);
    }
    
    public function payments()
    {
        return $this->hasMany(Payment::class);
    }
}