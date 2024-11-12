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
            'name' => 'gabah',
            'category' => 'gabah jenis 1'
        ]);
        TypeOfProduct::factory(10)->create();
    }
}
