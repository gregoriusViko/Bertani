<?php

namespace Database\Seeders;

use App\Models\HistoryPrice;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class HistoryPriceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        HistoryPrice::create([        
        'product_id'=>1,
        'price'=>7000
    ]);

    HistoryPrice::create([        
        'product_id'=>5,
        'price'=>8000
    ]);

    HistoryPrice::create([        
        'product_id'=>13,
        'price'=>20000
    ]);

    HistoryPrice::create([        
        'product_id'=>46,
        'price'=>17000
    ]);

    }
}
