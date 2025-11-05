<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Category extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'image',
        'is_active',
    ];

    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', 1);
    }

    public function getImageUrlAttribute()
    {
        if($this->image) {
            return Storage::url($this->image);
        }

        return asset('images/default-image.png');

    }
}
