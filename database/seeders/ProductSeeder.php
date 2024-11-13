<?php

namespace Database\Seeders;

use App\Models\Farmer;
use App\Models\Product;
use App\Models\TypeOfProduct;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Product::factory(count: 100)->recycle([
            Farmer::all(),
            TypeOfProduct::all(),
        ])->create();
    }
}
