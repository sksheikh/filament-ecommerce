<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        \Illuminate\Support\Facades\Schema::disableForeignKeyConstraints();
        Category::truncate();
        \Illuminate\Support\Facades\Schema::enableForeignKeyConstraints();

        $categories = [
            ['name' => 'Smartphones', 'image' => 'https://images.unsplash.com/photo-1598327105666-5b89351aff97?q=80&w=800&auto=format&fit=crop'],
            ['name' => 'Laptops', 'image' => 'https://images.unsplash.com/photo-1496181133206-80ce9b88a853?q=80&w=800&auto=format&fit=crop'],
            ['name' => 'Smart Watches', 'image' => 'https://images.unsplash.com/photo-1508685096489-7aacd43bd3b1?q=80&w=800&auto=format&fit=crop'],
            ['name' => 'Accessories', 'image' => 'https://images.unsplash.com/photo-1523275335684-37898b6baf30?q=80&w=800&auto=format&fit=crop'],
            ['name' => 'Tablets', 'image' => 'https://images.unsplash.com/photo-1511707171634-5f897ff02aa9?q=80&w=800&auto=format&fit=crop'],
            ['name' => 'Cameras', 'image' => 'https://images.unsplash.com/photo-1526170315870-ef6d82f583ad?q=80&w=800&auto=format&fit=crop'],
            ['name' => 'Headphones', 'image' => 'https://images.unsplash.com/photo-1505740420928-5e560c06d30e?q=80&w=800&auto=format&fit=crop'],
            ['name' => 'Gaming', 'image' => 'https://images.unsplash.com/photo-1593305841991-05c297ba4575?q=80&w=800&auto=format&fit=crop'],
            ['name' => 'Smart Home', 'image' => 'https://images.unsplash.com/photo-1558002038-1055907df827?q=80&w=800&auto=format&fit=crop'],
            ['name' => 'Drones', 'image' => 'https://images.unsplash.com/photo-1473968512647-3e4402eb962f?q=80&w=800&auto=format&fit=crop'],
        ];

        foreach ($categories as $cat) {
            Category::create([
                'name' => $cat['name'],
                'slug' => Str::slug($cat['name']),
                'image' => $cat['image'],
                'is_active' => true,
            ]);
        }
    }
}
