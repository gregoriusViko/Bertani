<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    function home(){
        $products = Product::with('farmer')->paginate(10);
        return view('HomePageDefault', compact('products'));
    }

    public function loadMoreProducts(Request $request)
    {
        $products = Product::with('farmer')->paginate(perPage: 7);
        return view('partials.product', compact('products'))->render();
    }
}
