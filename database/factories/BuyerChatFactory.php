<?php

namespace Database\Factories;

use App\Models\Buyer;
use App\Models\Farmer;
use Illuminate\Support\Arr;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\BuyerChat>
 */
class BuyerChatFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'buyer_id' => Buyer::factory(),
            'farmer_id' => Farmer::factory(),
            'role_of_buyer' => Arr::random(['receiver', 'sender']),
            'is_read' => rand(0, 1),
            'content' => fake()->realText()
        ];
    }
}
