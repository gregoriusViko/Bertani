<?php

namespace Database\Seeders;

use App\Models\Buyer;
use App\Models\Order;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Order::factory(75)->recycle([
            Buyer::all()
        ])->create();
    }
}
