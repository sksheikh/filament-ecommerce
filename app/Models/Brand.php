<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Brand extends Model
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

    public function getImageUrlAttribute()
    {
        if (!$this->image) {
            return asset('images/default-image.png');
        }

        if (filter_var($this->image, FILTER_VALIDATE_URL)) {
            return $this->image;
        }

        return \Illuminate\Support\Facades\Storage::url($this->image);
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', 1);
    }
}
