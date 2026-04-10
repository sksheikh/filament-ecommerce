<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Seed brands, categories, products and users
        $this->call([
            \Database\Seeders\LocationSeeder::class,
            \Database\Seeders\RoleSeeder::class,
            \Database\Seeders\BrandSeeder::class,
            \Database\Seeders\CategorySeeder::class,
            \Database\Seeders\ProductSeeder::class,
            \Database\Seeders\UserSeeder::class,
            \Database\Seeders\CustomerSeeder::class,
            \Database\Seeders\SettingSeeder::class,
            \Database\Seeders\CmsSeeder::class,
            \Database\Seeders\DeliveryChargeSeeder::class,
        ]);
    }
}
