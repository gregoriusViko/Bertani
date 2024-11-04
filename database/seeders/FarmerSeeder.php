<?php

namespace Database\Seeders;

use App\Models\Farmer;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class FarmerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Farmer::create([
            'email_address' => 'petani@gmail.com',
            'password' => 'petani1234',
            'name' => 'petani 1',
            'phone_number' => '087234455234',
            'home_address' => 'http//tidak-tau'
        ]);
        Farmer::factory(25)->create();
    }
}
