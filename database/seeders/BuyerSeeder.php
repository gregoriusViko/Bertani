<?php

namespace Database\Seeders;

use App\Models\Buyer;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class BuyerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Buyer::create([
            'email_address' => 'pembeli@gmail.com',
            'password' => 'Pembeli1234',
            'name' => 'Pembeli 1',
            'phone_number' => '087234451234',
            'profile_img_link' => '/buyers/pembeli.jpg',
            'home_address' => 'http//tidak-tau'
        ]);
        Buyer::factory(50)->create();
    }
}
