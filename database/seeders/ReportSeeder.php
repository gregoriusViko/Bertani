<?php

namespace Database\Seeders;

use App\Models\Buyer;
use App\Models\Order;
use App\Models\Farmer;
use App\Models\Report;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ReportSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Report::factory(100)->recycle([
            Buyer::all(),
            Farmer::all(),
            Order::all()
        ])->create();
    }
}
