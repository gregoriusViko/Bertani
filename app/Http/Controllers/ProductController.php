<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Contracts\Validation\Validator;
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

    public function create() {
        return view('product.create');
    }

    public function Toko(Request $request){
        $request->validate([
            'name' => 'required|string|max:50',
            'price' => 'required|numeric',
            'description' => 'required',
            'stock_kg' => 'required|decimal',
            'selling_unit_kg' => 'required|decimal',
        ]);

        Product::create([
            'name' => $request->name,
            'price' => $request->price,
            'description' => $request->description,
            'stock_kg' => $request->stock_kg,
            'selling_unit_kg' => $request->selling_unit_kg,
            'product_type' => $request->product_type,
            'img_link' => $request->img_link,
        ]);

        return redirect()->route('')->with('success', 'sukses menambahkan produk');
    }

}
