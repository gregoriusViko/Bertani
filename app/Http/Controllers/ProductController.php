<?php

namespace App\Http\Controllers;

use App\Models\HistoryPrice;
use App\Models\Product;
use App\Models\TypeOfProduct;
use Hamcrest\Description;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;


class ProductController extends Controller
{
    function home()
    {
        $products = Product::with(['orders'])->latest()->paginate(12);
        return view('HomePageDefault', compact('products'));
    }

    function show($id)
    {
        $product = Product::findOrFail($id); // Mencari produk berdasarkan ID, atau mengembalikan 404 jika tidak ditemukan
        return view('DetailProductPage', compact('product'));
    }

    public function loadMoreProducts(Request $request)
    {
        $products = Product::with(['orders'])->latest()->paginate(perPage: 12);
        return view('partials.product', compact('products'))->render();
    }
    public function farmerProducts()
    {
        $farmer = Auth::guard('farmer')->user();
        $products = $farmer->products;
        return view('petani.PetDafProdPage', compact('products'));
    }

    public function create()
    {
        // Mengambil kategori unik saja (sayuran, buah, biji-bijian)
        $categories = TypeOfProduct::select('category')->distinct()->get();
        return view('petani.addProduct', compact('categories'));
    }

    public function getProductsByCategory($category)
    {
        // Ambil nama produk berdasarkan kategori dari tabel TypeOfProduct
        $products = TypeOfProduct::where('category', $category)->pluck('name', 'id');
        return response()->json($products);
    }

    public function Toko(Request $request)
    {
        $request->validate([
            'nama' => 'required|string',
            'harga' => 'required|numeric',
            'deskripsi' => 'required',
            'stok' => 'required|numeric|regex:/^\d+(\.\d{1,2})?$/',
            'jenis' => 'required',
            'foto' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);


        $foto = $request->file('foto');
        $foto->store('products', 'public');
        $typeOfProduct = TypeOfProduct::find($request->nama);
        if (!$typeOfProduct) {
            return back()->withErrors(['Nama' => 'nama produk tidak ditemukan.']);
        }

        $prod = Product::onlyTrashed()
            ->where('farmer_id', Auth::guard('farmer')->user()->id)
            ->where('type_of_product_id', $typeOfProduct->id)
            ->first();

        // Jika produk ditemukan dan sudah dihapus, lakukan restore
        if ($prod) {
            // Mengembalikan produk yang dihapus (restore)
            $prod->restore();
        }

        $farmer = Auth::guard('farmer')->user();
        $prod = Product::updateOrCreate(
            [
                'farmer_id' => $farmer->id,
                'type_of_product_id' => $typeOfProduct->id
            ],
            [
                'slug' => Str::slug($farmer->email . '-' . $typeOfProduct->name),
                'name' => $request->nama,
                'price' => $request->harga,
                'description' => $request->deskripsi,
                'stock_kg' => $request->stok,
                'img_link' => '/storage/products/' . $foto->hashName(),
            ]
        );

        HistoryPrice::Create([
            'price' => $request->harga,
            'product_id' => $prod->id,
        ]);

        return redirect('petani/dafproduk')->with('SuksesTambah', 'Berhasil');
    }

    public function edit(Product $product)
    {
        if ($product->farmer->id == Auth::guard('farmer')->user()->id) {
            return view('petani.editProduct', compact('product'));
        } else {
            abort(404);
        }
    }

    public function update(Request $request, Product $product)
    {

        $request->validate([
            'harga' => 'required|numeric',
            'deskripsi' => 'required',
            'stok' => 'required|numeric|regex:/^\d+(\.\d{1,2})?$/',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        if ($request->file('foto')) {
            File::delete(public_path($product->img_link));
            $foto = $request->file('foto');
            $foto->store('products', 'public');
            $product->img_link = '/storage/products/' . $foto->hashName();
        }

        $product->description = $request->deskripsi;
        $product->stock_kg = $request->stok;

        if ($product->price !=  $request->harga) {
            $product->price = $request->harga;
            HistoryPrice::Create([
                'price' => $request->harga,
                'product_id' => $product->id,
            ]);
        }

        $product->update();

        return redirect()->route('dafproduk')->with('SuksesUpdate', 'Berhasil');
    }


    public function destroy(Request $request)
    {
        $product = Product::find($request->product);
        if($product->farmer->id !== Auth::guard('farmer')->user()->id){
            abort(404);
        }
        try {
            $product->delete();

            DB::commit();

            return redirect('petani/dafproduk')->with('SuksesHapus', 'Berhasil menghapus produk.');
        } catch (\Exception $e) {
            DB::rollBack();

            Log::error('Error deleting product: ' . $e->getMessage());

            return redirect()->back()->with('GagalHapus', 'Gagal menghapus produk. ' . $e->getMessage());
        }
    }


    public function laporanPenjualan()
    {
        $farmer = Auth::guard('farmer')->user();
        $orders = $farmer->products()->with('orders')->latest()->get()->pluck('orders')->flatten();
        $start = now()->subMonth(3);
        $until = now();
        $orders = $orders->where('order_status', 'selesai')->whereBetween('order_time', [$start, $until]);
        return view('petani.PetLaporanPenjualanPage', compact('orders'));
    }

    public function rentangPenjualan(Request $request)
    {
        $bulan = $request->input('bulan');
        $farmer = Auth::guard('farmer')->user();
        $orders = $farmer->products()->with('orders')->latest()->get()->pluck('orders')->flatten();
        if ($bulan !== 'all') {
            $orders = $orders->where('order_status', 'selesai')->whereBetween('order_time', [now()->subMonth($bulan), now()]);
        }
        return view('partials.data', compact('orders'));
    }

    // public function loadMoreProducts(Request $request)
    // {
    //     $products = Product::with('farmer')->paginate(perPage: 8);
    //     return view('partials.product', compact('products'))->render();
    // }
}
