<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Customer>
 */
class CustomerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
            'email' => $this->faker->unique()->safeEmail(),
            'password' => \Illuminate\Support\Facades\Hash::make('password'),
            'phone' => $this->faker->phoneNumber(),
            'is_active' => true,
            'email_verified_at' => now(),
            'remember_token' => \Illuminate\Support\Str::random(10),
        ];
    }
}
