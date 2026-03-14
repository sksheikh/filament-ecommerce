<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Admin user (keep existing email if present)
        $admin = User::updateOrCreate([
            'email' => 'admin@app.com',
        ], [
            'name' => 'Admin',
            'password' => bcrypt('password'),
        ]);

        // Assign super_admin role
        if (!$admin->hasRole('super_admin')) {
            $admin->assignRole('super_admin');
        }
    }
}
