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
            'password' => 'vk24!%?dkrnr4$',
            'name' => 'Gregorius Viko',
            'phone_number' => '085290697615',
            'profile_img_link' => '/admins/viko.jpg'
        ]);

        Admin::create([
            'email' => 'nicolas@gmail.com',
            'password' => 'vk24!%?dkrnr4$',
            'name' => 'Nicholas',
            'phone_number' => '085290697611',
            'profile_img_link' => '/admins/viko.jpg'
        ]);

        Admin::create([
            'email' => 'angger@gmail.com',
            'password' => 'vk24!%?dkrnr4$',
            'name' => 'Angger',
            'phone_number' => '085290697612',
            'profile_img_link' => '/admins/viko.jpg'
        ]);

        Admin::create([
            'email' => 'boni@gmail.com',
            'password' => 'vk24!%?dkrnr4$',
            'name' => 'Raditya',
            'phone_number' => '085290697613',
            'profile_img_link' => '/admins/viko.jpg'
        ]);

        Admin::factory(5)->create();
    }
}
