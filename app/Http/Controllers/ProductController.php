<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    function home(){
        $products = Product::all();
        return view('HomePageDefault', compact('products'));
    }
}
