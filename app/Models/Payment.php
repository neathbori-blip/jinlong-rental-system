<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $table = 'payments';
    protected $primaryKey = 'id';
    protected $fillable = [
        'lease_id',
        'amount',
        'payment_date',
        'due_date',
        'payment_method',
        'status',
        'transaction_id',
        'notes'
    ];
    
    protected $casts = [
        'payment_date' => 'date',
        'due_date' => 'date',
    ];
    
    // Relationships
    public function lease()
    {
        return $this->belongsTo(Lease::class, 'lease_id');
    }
    
    //
    public function isLate()
    {
        return $this->due_date < now() && $this->status !== 'completed';
    }
}