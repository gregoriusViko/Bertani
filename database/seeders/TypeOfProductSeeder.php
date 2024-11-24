<?php

namespace Database\Seeders;

use App\Models\TypeOfProduct;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TypeOfProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        TypeOfProduct::create([
            'name' => 'semangka',
            'category' => 'buah',
            'market_price' => 7000
        ]);
        TypeOfProduct::create([
            'name' => 'melon',
            'category' => 'buah',
            'market_price' => 8000
        ]);
        TypeOfProduct::create([
            'name' => 'terong',
            'category' => 'sayuran',
            'market_price' => 9300
        ]);
        TypeOfProduct::create([
            'name' => 'tomat',
            'category' => 'sayuran',
            'market_price' => 17000
        ]);
        TypeOfProduct::create([
            'name' => 'gabah',
            'category' => 'biji-bijian',
            'market_price' => 7500
        ]);
        TypeOfProduct::create([
            'name' => 'cabai merah',
            'category' => 'sayuran',
            'market_price' => 20000
        ]);
        TypeOfProduct::create([
            'name' => 'jagung',
            'category' => 'biji-bijian',
            'market_price' => 7000
        ]);
    }
}
