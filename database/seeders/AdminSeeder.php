<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Admin::create([
            'email' => 'viko@gmail.com',
            'password' => 'Admin1234',
            'name' => 'Gregorius Viko',
            'phone_number' => '085290697615',
            'profile_img_link' => '/admins/viko.jpg'
        ]);

        Admin::factory(5)->create();
    }
}
