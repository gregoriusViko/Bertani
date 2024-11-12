<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Admin;
use App\Models\Buyer;
use App\Models\Order;
use App\Models\Farmer;
use App\Models\Report;
use App\Models\Product;
use App\Models\BuyerChat;
use App\Models\FarmerChat;
use App\Models\OrderDetail;
use Illuminate\Support\Str;
use App\Models\ReportDetail;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([AdminSeeder::class, BuyerSeeder::class, FarmerSeeder::class]);
        BuyerChat::factory(100)->recycle([
            Farmer::all(),
            Buyer::all()
        ])->create();

        FarmerChat::factory(100)->recycle([
            Buyer::all(),
            Farmer::all()
        ])->create();

        $this->call([OrderSeeder::class, ProductSeeder::class]);

        OrderDetail::factory(150)->recycle([
            Order::all(),
            Product::all()
        ])->create();

        $this->call(ReportSeeder::class);

        ReportDetail::factory(25)->recycle([
            Report::all(),
            Admin::all()
        ])->create();

        User::create([
            'name' => 'Pengguna1',
            'username' => 'pengguna',
            'email' => 'pengguna@gmail.com',
            'email_verified_at' => now(),
            'password' => 'pengguna1234',
            'remember_token' => Str::random(10)
        ]);
    }
}
