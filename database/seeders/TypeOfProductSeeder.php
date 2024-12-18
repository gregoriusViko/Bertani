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
            'name' => 'Semangka',
            'category' => 'buah',
            'market_price' => 7000
        ]);
        TypeOfProduct::create([
            'name' => 'Melon',
            'category' => 'buah',
            'market_price' => 8000
        ]);
        TypeOfProduct::create([
            'name' => 'Terong',
            'category' => 'sayuran',
            'market_price' => 9300
        ]);
        TypeOfProduct::create([
            'name' => 'Tomat',
            'category' => 'sayuran',
            'market_price' => 17000
        ]);
        TypeOfProduct::create([
            'name' => 'Gabah',
            'category' => 'biji-bijian',
            'market_price' => 7500
        ]);
        TypeOfProduct::create([
            'name' => 'Cabai Merah Keriting',
            'category' => 'sayuran',
            'market_price' => 37000
        ]);
        TypeOfProduct::create([
            'name' => 'Cabai Rawit Merah',
            'category' => 'sayuran',
            'market_price' => 45000
        ]);
        TypeOfProduct::create([
            'name' => 'Cabai Merah Besar',
            'category' => 'sayuran',
            'market_price' => 40000
        ]);
        TypeOfProduct::create([
            'name' => 'Jagung',
            'category' => 'biji-bijian',
            'market_price' => 7000
        ]);
        TypeOfProduct::create([
            'name' => 'Kacang Tanah',
            'category' => 'biji-bijian',
            'market_price' => 28000
        ]);
    }
}
