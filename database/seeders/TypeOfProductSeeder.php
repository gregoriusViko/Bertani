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
            'category' => 'buah'
        ]);
        TypeOfProduct::create([
            'name' => 'melon',
            'category' => 'buah'
        ]);
        TypeOfProduct::create([
            'name' => 'terong',
            'category' => 'sayuran'
        ]);
        TypeOfProduct::create([
            'name' => 'tomat',
            'category' => 'sayuran'
        ]);
        TypeOfProduct::create([
            'name' => 'melon',
            'category' => 'buah'
        ]);
        TypeOfProduct::create([
            'name' => 'gabah',
            'category' => 'biji-bijian'
        ]);
        TypeOfProduct::create([
            'name' => 'cabai merah',
            'category' => 'sayuran'
        ]);
    }
}
