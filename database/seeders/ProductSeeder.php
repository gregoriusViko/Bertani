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
        Product::create([
            'farmer_id' => 1,
            'type_of_product_id' => 1,
            'description'=>fake()->realText(),
            'stock_kg'=>fake()->randomFloat(2, 0, 10000),
            'price' => fake()->randomFloat(0, 1000, 1000000),
            'slug' => fake()->slug(),
            'img_link' => '/img/logo3.jpg'
        ]);
        Product::factory(count: 200)->recycle([
            Farmer::all(),
            TypeOfProduct::all(),
        ])->create();
    }
}
