<?php

namespace Database\Factories;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Farmer>
 */
class FarmerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $email = fake()->unique()->safeEmail();
        return [
            'email' => $email,
            'password' => Str::random(10),
            'name' => fake()->unique()->name(),
            'phone_number' => fake()->unique()->phoneNumber(),
            'slug' => Str::slug($email),
            'home_address' => fake()->url()
        ];
    }
}
