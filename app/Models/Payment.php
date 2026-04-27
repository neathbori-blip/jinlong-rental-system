<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $fillable = [
        'tenant_id', 'amount', 'payment_date', 'payment_method',
        'receipt_number', 'notes', 'status'
    ];

    protected $casts = [
        'payment_date' => 'date',
        'amount' => 'decimal:2',
    ];

    public function tenant()
    {
        return $this->belongsTo(Tenant::class);
    }

    // Accessor for formatted amount
    public function getFormattedAmountAttribute()
    {
        return '$' . number_format($this->amount, 2);
    }
    
    // app/Models/Tenant.php (add this method)
public function payments()
{
    return $this->hasMany(Payment::class);
}
}