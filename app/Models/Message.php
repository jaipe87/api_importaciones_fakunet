<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $fillable = [
        'firstName',
        'lastName',
        'phone',
        'email',
        'content',
        'date',
        'read',
    ];

    protected $casts = [
        'date' => 'datetime',
        'read' => 'boolean',
    ];
}
