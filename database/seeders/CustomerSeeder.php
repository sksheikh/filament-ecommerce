<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\Customer::updateOrCreate([
            'first_name' => 'Demo',
            'last_name' => 'Customer',
            'email' => 'customer@app.com',
        ], [
            'password' => \Illuminate\Support\Facades\Hash::make('password'),
            'phone' => '1234567890',
            'is_active' => true,
        ]);

        \App\Models\Customer::updateOrCreate([
            'first_name' => 'Inactive',
            'last_name' => 'Customer',
            'email' => 'inactive@app.com',
        ], [
            'password' => \Illuminate\Support\Facades\Hash::make('password'),
            'phone' => '0987654321',
            'is_active' => false,
        ]);
    }
}
