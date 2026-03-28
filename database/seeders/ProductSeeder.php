<?php

namespace Database\Seeders;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        \Illuminate\Support\Facades\Schema::disableForeignKeyConstraints();
        Product::truncate();
        \Illuminate\Support\Facades\Schema::enableForeignKeyConstraints();

        $brands = Brand::all()->pluck('id', 'name')->toArray();
        $categories = Category::all()->pluck('id', 'name')->toArray();

        $products = [
            // Smartphones
            [
                'name' => 'iPhone 15 Pro Max',
                'category_id' => $categories['Smartphones'] ?? 1,
                'brand_id' => $brands['Apple'] ?? 1,
                'price' => 155000,
                'is_featured' => true,
                'on_sale' => true,
                'description' => 'The ultimate iPhone with titanium design and A17 pro chip.',
                'images' => [
                    'https://images.unsplash.com/photo-1696446701796-da61225697cc?q=80&w=800',
                    'https://images.unsplash.com/photo-1696446702183-cbd13d789053?q=80&w=800',
                    'https://images.unsplash.com/photo-1696446702517-8147d3464161?q=80&w=800'
                ]
            ],
            [
                'name' => 'Galaxy S24 Ultra',
                'category_id' => $categories['Smartphones'] ?? 1,
                'brand_id' => $brands['Samsung'] ?? 1,
                'price' => 145000,
                'is_featured' => true,
                'on_sale' => false,
                'description' => 'Titanium built, Galaxy AI powered flagship.',
                'images' => [
                    'https://images.unsplash.com/photo-1707231459056-9a2f7c0c107f?q=80&w=800',
                    'https://images.unsplash.com/photo-1707231459530-5b1287c897f2?q=80&w=800'
                ]
            ],
            // Laptops
            [
                'name' => 'MacBook Pro M3 Max',
                'category_id' => $categories['Laptops'] ?? 1,
                'brand_id' => $brands['Apple'] ?? 1,
                'price' => 385000,
                'is_featured' => true,
                'on_sale' => false,
                'description' => 'The ultimate power for pros. Space black finish.',
                'images' => [
                    'https://images.unsplash.com/photo-1517336714731-489689fd1ca8?q=80&w=800',
                    'https://images.unsplash.com/photo-1611186871348-b1ec696e52c9?q=80&w=800'
                ]
            ],
            [
                'name' => 'Dell XPS 13 Plus',
                'category_id' => $categories['Laptops'] ?? 1,
                'brand_id' => $brands['Dell'] ?? 1,
                'price' => 210000,
                'is_featured' => false,
                'on_sale' => true,
                'description' => 'Simplistic elegance meeting high-end performance.',
                'images' => [
                    'https://images.unsplash.com/photo-1593642632823-8f785ba67e45?q=80&w=800',
                    'https://images.unsplash.com/photo-1593642702821-c8da6771f0c6?q=80&w=800'
                ]
            ],
            // Headphones
            [
                'name' => 'Sony WH-1000XM5',
                'category_id' => $categories['Headphones'] ?? 1,
                'brand_id' => $brands['Sony'] ?? 2,
                'price' => 38000,
                'is_featured' => true,
                'on_sale' => false,
                'description' => 'Your world, anything else is noise. Best noise cancelling.',
                'images' => [
                    'https://images.unsplash.com/photo-1546435770-a3e426ff472b?q=80&w=800',
                    'https://images.unsplash.com/photo-1505740420928-5e560c06d30e?q=80&w=800'
                ]
            ],
            // Gaming
            [
                'name' => 'PlayStation 5 Console',
                'category_id' => $categories['Gaming'] ?? 1,
                'brand_id' => $brands['Sony'] ?? 2,
                'price' => 65000,
                'is_featured' => true,
                'on_sale' => false,
                'description' => 'Stunning 4K gaming and lightning fast SSD.',
                'images' => [
                    'https://images.unsplash.com/photo-1606144042614-b2417e99c4e3?q=80&w=800',
                    'https://images.unsplash.com/photo-1606813907291-d86efa9b94db?q=80&w=800'
                ]
            ],
            // Watches
            [
                'name' => 'Apple Watch Ultra 2',
                'category_id' => $categories['Smart Watches'] ?? 1,
                'brand_id' => $brands['Apple'] ?? 1,
                'price' => 95000,
                'is_featured' => true,
                'on_sale' => false,
                'description' => 'The ultimate endurance watch for the explorer.',
                'images' => [
                    'https://images.unsplash.com/photo-1434493907317-a46b53b81882?q=80&w=800',
                    'https://images.unsplash.com/photo-1544117518-335622340f1a?q=80&w=800'
                ]
            ],
            [
                'name' => 'LG C3 OLED TV 65"',
                'category_id' => $categories['Smart Home'] ?? 1,
                'brand_id' => $brands['LG'] ?? 1,
                'price' => 245000,
                'is_featured' => true,
                'on_sale' => false,
                'description' => 'Perfect black, infinite contrast, brilliant color.',
                'images' => [
                    'https://images.unsplash.com/photo-1593305841991-05c297ba4575?q=80&w=800',
                    'https://images.unsplash.com/photo-1552975084-6e027cd345c2?q=80&w=800'
                ]
            ],
        ];

        foreach ($products as $prod) {
            Product::create([
                'category_id' => $prod['category_id'],
                'brand_id' => $prod['brand_id'],
                'name' => $prod['name'],
                'slug' => Str::slug($prod['name']),
                'images' => $prod['images'], // Array will be cast to JSON
                'description' => $prod['description'],
                'price' => $prod['price'],
                'is_active' => true,
                'is_featured' => $prod['is_featured'],
                'is_stock' => true,
                'on_sale' => $prod['on_sale'],
            ]);
        }
    }
}
