<?php

namespace Database\Factories;

use App\Models\Farmer;
use App\Models\TypeOfProduct;
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
            'type_of_product_id' => TypeOfProduct::factory(),
            'description'=>fake()->realText(),
            'stock_kg'=>fake()->randomFloat(2, 0, 10000),
            'price' => fake()->randomFloat(0, 1000, 1000000),
            'slug' => fake()->unique()->slug,
            'img_link' => 'tidaktau'
        ];
    }
}
