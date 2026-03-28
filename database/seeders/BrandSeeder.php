<?php

namespace Database\Seeders;

use App\Models\Brand;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class BrandSeeder extends Seeder
{
    public function run(): void
    {
        \Illuminate\Support\Facades\Schema::disableForeignKeyConstraints();
        Brand::truncate();
        \Illuminate\Support\Facades\Schema::enableForeignKeyConstraints();

        $brands = [
            ['name' => 'Apple', 'image' => 'https://logo.clearbit.com/apple.com'],
            ['name' => 'Samsung', 'image' => 'https://logo.clearbit.com/samsung.com'],
            ['name' => 'Sony', 'image' => 'https://logo.clearbit.com/sony.com'],
            ['name' => 'HP', 'image' => 'https://logo.clearbit.com/hp.com'],
            ['name' => 'Dell', 'image' => 'https://logo.clearbit.com/dell.com'],
            ['name' => 'Microsoft', 'image' => 'https://logo.clearbit.com/microsoft.com'],
            ['name' => 'LG', 'image' => 'https://logo.clearbit.com/lg.com'],
        ];

        foreach ($brands as $brand) {
            Brand::create([
                'name' => $brand['name'],
                'slug' => Str::slug($brand['name']),
                'image' => $brand['image'],
                'is_active' => true,
            ]);
        }
    }
}
