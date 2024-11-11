<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use illuminate\Support\Facades\Storage;


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
            'img_link' => 'required|images|mimes:jpeg,png,jpg'
        ]);

        $foto = $request->file('foto');
        $foto->storeAs('public', $foto->hashName());

        Product::create([
            'name' => $request->name,
            'price' => $request->price,
            'description' => $request->description,
            'stock_kg' => $request->stock_kg,
            'selling_unit_kg' => $request->selling_unit_kg,
            'product_type' => $request->product_type,
            'img_link' => $foto->hashName(),
        ]);

        return redirect()->route('')->with('success', 'sukses menambahkan produk');
    }

    public function edit(Product $product) {
        return view('product.edit', compact('product'));
    }

    public function update(Request $request, Product $product) {
        $request->validate([
            'name' => 'required|string|max:50',
            'price' => 'required|numeric',
            'description' => 'required',
            'stock_kg' => 'required|decimal',
            'selling_unit_kg' => 'required|decimal',
        ]);

        $product->name = $request->name;
        $product->price = $request->price;
        $product->description = $request->description;
        $product->stock_kg = $request->stock_kg;
        $product->selling_unit_kg = $request->selling_unit_kg;

        if  ($request->file('foto')) {

            Storage::disk('local')->delete('public/'. $product->foto);
            $foto = $request->file('foto');
            $foto->storeAs('public', $foto->hashName());
            $product->foto = $foto->hashName();
        }

        $product->update();

        return redirect()->route('')->with('Sukses', 'Berhasil update produk');
    }

    public function destroy(Product $product){
        if($product->foto !== "noimage.png") {
        Storage::disk('local')->delete('public/'. $product->foto);
        }

        $product->delete();
        return redirect('')->with('Sukses', 'Berhasil Hapus Produk');
    }

}
