<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    function home(){
        $products = Product::with('farmer')->paginate(12);
        return view('HomePageDefault', compact('products'));
    }

    function show($id){
        $product = Product::findOrFail($id); // Mencari produk berdasarkan ID, atau mengembalikan 404 jika tidak ditemukan
        return view('products.show', compact('product'));
    }

    public function loadMoreProducts(Request $request)
    {
        $products = Product::with('farmer')->paginate(perPage: 8);
        return view('partials.product', compact('products'))->render();
    }

    public function farmerProducts(){
        $farmer = Auth::guard('farmer')->user();
        $products = $farmer->products;
        return view('PetDafProdPage', compact('products'));
    }
}
