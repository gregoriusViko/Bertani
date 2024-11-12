<?php

namespace Database\Seeders;

use App\Models\Buyer;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class BuyerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $pembeli1 = 'pembeli@gmail.com';
        Buyer::create([
            'email' => $pembeli1,
            'password' => 'Pembeli1234',
            'name' => 'Pembeli 1',
            'phone_number' => '087234451234',
            'slug' => Str::slug($pembeli1),
            'profile_img_link' => '/buyers/pembeli.jpg',
            'home_address' => 'http//tidak-tau'
        ]);
        Buyer::factory(50)->create();
    }
}
