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
        return view('petani.PetDafProdPage', compact('products'));
    }

    public function create() {
        return view('petani.addProduct');
    }

    public function Toko(Request $request){
        $request->validate([
            'nama' => 'required|string|max:50',
            'harga' => 'required|numeric',
            'deskripsi' => 'required',
            'stok' => 'required|numeric|regex:/^\d+(\.\d{1,2})?$/',
            // 'selling_unit_kg' => 'required|numeric|regex:/^\d+(\.\d{1,2})?$/',
            'jenis' => 'required',
            'foto' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);
        $foto = $request->file('foto');
        $foto->store('products', 'public');
        Product::create([
            'farmer_id' => Auth::guard('farmer')->user()->id,
            'name' => $request->nama,
            'price' => $request->harga,
            'description' => $request->deskripsi,
            'stock_kg' => $request->stok,
            'product_type' => $request->jenis,
            'img_link' => '/storage/products/'.$foto->hashName(),
        ]);

        return redirect('dafproduk')->with('Sukses', 'Berhasil menambahkan produk');
    }

    public function edit(Product $product) {
        return view('product.edit', compact('product'));
    }

    public function update(Request $request, Product $product) {
        $request->validate([
            'nama' => 'required|string|max:50',
            'harga' => 'required|numeric',
            'deskripsi' => 'required',
            'stok' => 'required|numeric|regex:/^\d+(\.\d{1,2})?$/',
            'selling_unit_kg' => 'required|numeric|regex:/^\d+(\.\d{1,2})?$/',
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
            $product->foto = '/storage/products'.$foto->hashName();
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
