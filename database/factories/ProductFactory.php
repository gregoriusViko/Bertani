<?php

namespace Database\Factories;

use App\Models\Farmer;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'farmer_id' => Farmer::factory(),
            'name'=>fake()->text(5),
            'description'=>fake()->realText(),
            'stock'=>fake()->randomFloat(2, 1, 1000),
            'product_type' => fake()->text(5),
            'price' => fake()->randomFloat(2, 1000, 1000000),
            'img_link' => fake()->url()
        ];
    }
}
