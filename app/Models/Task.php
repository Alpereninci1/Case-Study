<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $fillable =[
        'name',
        'duration',
        'difficulty',
        'developer',
    ];

    protected $casts = [
      'created_at' => 'datetime',
      'updated_at' => 'datetime'
    ];
}
