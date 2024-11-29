<?php

namespace Database\Seeders;

use App\Models\Buyer;
use App\Models\Farmer;
use App\Models\BuyerChat;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class BuyerChatSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        BuyerChat::create([
            'buyer_id' => Buyer::first()->id,
            'farmer_id' => 5,
            'role' => 'sender',
            'is_read' => 1,
            // 'send_time' => now(),
            'content' => 'semoga berhasil'
        ]);
    }
}
