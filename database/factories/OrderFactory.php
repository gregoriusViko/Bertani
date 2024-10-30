<?php

namespace Database\Factories;

use App\Models\Buyer;
use Illuminate\Support\Arr;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Order>
 */
class OrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $randomString = strtoupper(fake()->lexify('???')) . '-' . fake()->randomNumber(3, true);
        return [
            'buyer_id' => Buyer::factory(),
            'payment_proof' => Arr::random(['COD', 'transfer']),
            'receipt_number' => $randomString,
            'order_status' => Arr::random(['done', 'waiting for acceptance', 'request accepted', 'denied'])
        ];
    }
}
