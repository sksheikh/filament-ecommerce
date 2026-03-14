<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $settings = [
            'site_name' => 'Laravel Filament Shop',
            'site_email' => 'contact@example.com',
            'phone' => '+880123456789',
            'shop_address' => 'Dhaka, Bangladesh',
            'shop_description' => 'A modern e-commerce platform built with Laravel and Filament.',
            'currency' => 'BDT',
            'footer_text' => '© 2026 Laravel Filament Shop. All rights reserved.',
            'bkash_number' => '01700000000',
        ];

        foreach ($settings as $key => $value) {
            Setting::updateOrCreate(
                ['key' => $key],
                ['value' => $value]
            );
        }
    }
}
