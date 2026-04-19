<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tenant extends Model
{
    protected $fillable = ['name', 'email', 'phone', 'property_id', 'move_in_date', 'status'];
    
    public function property()
    {
        return $this->belongsTo(Property::class);
    }
    
    public function payments()
    {
        return $this->hasMany(Payment::class);
    }
}