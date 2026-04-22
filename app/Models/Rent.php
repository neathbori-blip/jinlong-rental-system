<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rent extends Model
{
    protected $fillable = [
        'item_name',
        'customer_name',
        'rental_days',
        'total_price',
    ];
}