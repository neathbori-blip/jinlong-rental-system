<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    // Only these fields can be filled (Security)
    protected $fillable = ['name', 'email', 'password'];

    // Sensitive data that should never be shown in JSON/Arrays
    protected $hidden = ['password', 'remember_token'];

    // Logic: Automatically hash the password when it's saved
    protected $casts = [
        'password' => 'hashed',
    ];
}