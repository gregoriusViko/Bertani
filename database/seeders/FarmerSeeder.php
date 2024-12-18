<?php

namespace Database\Seeders;

use App\Models\Farmer;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class FarmerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $petani = 'petani@gmail.com';
        Farmer::create([
            'email' => $petani,
            'password' => 'petani1234',
            'name' => 'petani 1',
            'phone_number' => '087234455234',
            'slug' => Str::slug($petani),
            'email_verified_at' => now(),
            'home_address' => 'http//tidak-tau'
        ]);
        Farmer::factory(25)->create();
    }
}
