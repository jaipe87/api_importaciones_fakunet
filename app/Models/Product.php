<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'code',
        'name',
        'brand',
        'category',
        'description',
        'features',
        'stock',
        'whatsapp_message',
        'image_url',
        'active',
        'pdf_url',
    ];

    protected $casts = [
        'features' => 'array',
        'active' => 'boolean',
    ];
}
