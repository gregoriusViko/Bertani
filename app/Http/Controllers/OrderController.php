<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    function daftarOrder(){
        $farmer = Auth::guard('farmer')->user();
        // $orders = $farmer->products()->with('orders')->get()->pluck('orders')->flatten();
        dd($farmer->products);
        return view('petani.PetDafPesananPage');
    }
}
