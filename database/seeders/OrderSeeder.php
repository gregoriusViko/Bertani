<?php

namespace Database\Seeders;

use App\Models\Buyer;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Support\Arr;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Order::create([
            'buyer_id' => 1,
            'product_id' => 1,
            'payment_proof' => Arr::random(['COD', 'transfer']),
            'receipt_number' => strtoupper(fake()->lexify('???')) . '-' . fake()->randomNumber(3, true),
            'price_id' => 1,
            'quantity_kg'=>fake()->randomFloat(2, 1, 1000),
            'order_status' => 'selesai'
        ]);
        Order::create([
            'buyer_id' => 1,
            'product_id' => 1,
            'payment_proof' => Arr::random(['COD', 'transfer']),
            'receipt_number' => strtoupper(fake()->lexify('???')) . '-' . fake()->randomNumber(3, true),
            'price_id' => 1,
            'quantity_kg'=>fake()->randomFloat(2, 1, 1000),
            'order_status' => 'menunggu konfirmasi'
        ]);
        Order::create([
            'buyer_id' => 1,
            'product_id' => 1,
            'payment_proof' => Arr::random(['COD', 'transfer']),
            'receipt_number' => strtoupper(fake()->lexify('???')) . '-' . fake()->randomNumber(3, true),
            'price_id' => 1,
            'quantity_kg'=>fake()->randomFloat(2, 1, 1000),
            'order_status' => 'permintaan diterima'
        ]);
        Order::create([
            'buyer_id' => 1,
            'product_id' => 1,
            'payment_proof' => Arr::random(['COD', 'transfer']),
            'receipt_number' => strtoupper(fake()->lexify('???')) . '-' . fake()->randomNumber(3, true),
            'price_id' => 1,
            'quantity_kg'=>fake()->randomFloat(2, 1, 1000),
            'order_status' => 'ditolak'
        ]);
        Order::factory(75)->recycle([
            Buyer::all(),
            Product::all()
        ])->create();
    }
}
