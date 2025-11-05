<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Product extends Model
{
    protected $appends = ['image_urls'];
    protected $fillable = [
        'category_id',
        'brand_id',
        'name',
        'slug',
        'images',
        'description',
        'price',
        'is_active',
        'is_featured',
        'is_stock',
        'on_sale',
    ];

    protected $casts = [
        'images' => 'array',
        'is_active' => 'boolean',
        'is_featured' => 'boolean',
        'is_stock' => 'boolean',
        'on_sale' => 'boolean',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function scopeFeatured($query)
    {
        return $query->where('is_featured', 1);
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', 1);
    }

    public function getImageUrlsAttribute()
    {
        if(!empty($this->images)){
           return collect($this->images)
            ->filter() // remove null/empty
            ->map(fn($image) => Storage::url($image))
            ->values()
            ->toArray();
        }

        return [asset('images/default-image.png')];

    }
}
