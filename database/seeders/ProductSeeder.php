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
        $brands = Brand::all();
        $categories = Category::all();

        if ($brands->isEmpty() || $categories->isEmpty()) {
            return;
        }

        // Create a few products across categories and brands
        foreach ($categories as $category) {
            for ($i = 1; $i <= 4; $i++) {
                $name = $category->name . ' Product ' . $i;
                Product::updateOrCreate([
                    'slug' => Str::slug($name),
                ], [
                    'category_id' => $category->id,
                    'brand_id' => $brands->random()->id,
                    'name' => $name,
                    'images' => null,
                    'description' => $name . ' description',
                    'price' => rand(1000, 20000) / 100,
                    'is_active' => 1,
                    'is_featured' => rand(0,1),
                    'is_stock' => 1,
                    'on_sale' => 0,
                ]);
            }
        }
    }
}
