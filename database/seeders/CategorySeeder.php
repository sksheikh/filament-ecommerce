<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            'Electronics',
            'Books',
            'Home & Garden'
        ];

        foreach ($categories as $name) {
            Category::updateOrCreate([
                'slug' => Str::slug($name),
            ], [
                'name' => $name,
                'image' => null,
                'is_active' => 1,
            ]);
        }
    }
}
