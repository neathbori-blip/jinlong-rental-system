<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $fillable = ['tenant_id', 'property_id', 'amount', 'payment_date', 'status', 'payment_method'];
    
    public function tenant()
    {
        return $this->belongsTo(Tenant::class);
    }
    
    public function property()
    {
        return $this->belongsTo(Property::class);
    }
}