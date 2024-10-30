<?php

namespace Database\Factories;

use App\Models\Buyer;
use App\Models\Farmer;
use App\Models\Order;
use Illuminate\Support\Arr;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Report>
 */
class ReportFactory extends Factory
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
            'order_id' => Order::factory(),
            'reporter' => Arr::random(['farmer', 'buyer'])
        ];
    }
}
