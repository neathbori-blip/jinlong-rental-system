<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $table = 'users';
    protected $primaryKey = 'id';
    protected $fillable = [
        'email', 
        'password', 
        'first_name', 
        'last_name', 
        'phone', 
        'role'
    ];
    
    protected $hidden = ['password'];
    
    // Relationships
    public function tenant()
    {
        return $this->hasOne(Tenant::class, 'user_id');
    }
    

}