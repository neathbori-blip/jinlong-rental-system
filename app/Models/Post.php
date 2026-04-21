<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    // Add this - specify which fields can be mass assigned
    protected $fillable = [
        'title',
        'content',
    ];
}