<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\Brand;
use App\Models\Category;

class Product extends Model
{
    use HasFactory;
    protected $fillable = [
        'code',
        'name',
        'brand_id',
        'category_id',
        'description',
        'features',
        'stock',
        'image_url',
        'pdf_url',
    ];

    protected $casts = [
        'features' => 'array',
    ];

    protected $hidden = [
        'brand_id',
        'category_id',
        'created_at',
        'updated_at',
    ];

    /**
     * Relación con Brand
     */
    public function brand(): BelongsTo
    {
        return $this->belongsTo(Brand::class);
    }

    /**
     * Relación con Category
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }
}
