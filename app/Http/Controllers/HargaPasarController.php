<?php

namespace App\Http\Controllers;
use App\Models\TypeOfProduct;

use Illuminate\Http\Request;

class HargaPasarController extends Controller
{
    
    public function editHargaPasar()
    {
        // Mengambil kategori unik dari tabel type_of_products
    // Mengambil semua kategori beserta produk dan harga pasar
    $categories = TypeOfProduct::select('category')
        ->distinct()
        ->with('product') // Mengambil produk berdasarkan kategori
        ->get();
        // Mengirim data categories ke view
        return view('admin.EditHargaPasar', compact('categories'));
    }

    
    public function getProductsByCategory($category){

        $products = TypeOfProduct::where('category', $category)
        ->pluck('name', 'id');

        return response()->json($products);
    }

    public function updateHargaPasar(Request $request){
        $request->validate([
            'categoryDropdown' => 'required',
            'nama' => 'required',       
            'harga' => 'required|numeric|min:0',
        ]);

        $typeOfProduct = TypeOfProduct::where('id', $request->nama)->first();

        if(!$typeOfProduct){
            return redirect()->back()->withErrors(['nama'=>'Produk tidak ditemukan']);
        }

        $typeOfProduct->update([
            'market_price'=>$request->harga,
        ]);

        return redirect()->route('admin.HargaPasar')->with('successUpdatePasar', 'Sukses');
    }

    public function melihatHargaPasar(){
        // Ambil semua produk dengan kategori dan harga pasar
        $categories = TypeOfProduct::select('name', 'category', 'market_price', 'updated_at')
        ->orderBy('category')
        ->orderBy('name')
        ->get();
        // Mengirimkan data ke view
        return view('MelihatHargaPasar', compact('categories'));
    }

    public function HargaPasar(){
        // Ambil semua produk dengan kategori dan harga pasar
        $categories = TypeOfProduct::select('name', 'category', 'market_price', 'updated_at')
        ->orderBy('category')
        ->orderBy('name')
        ->get();
        // Mengirimkan data ke view
        return view('admin.HargaPasar', compact('categories'));
    }

}
