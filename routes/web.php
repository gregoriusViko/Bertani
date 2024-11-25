<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SearchController;
use App\Models\Product;

require base_path('routes/admin.php');
require base_path('routes/buyer.php');
require base_path('routes/farmer.php');
require base_path('routes/auth.php');

Route::get('/', [ProductController::class, 'home'])->name('HomePageDefault');
Route::get('/products/load', [ProductController::class, 'loadMoreProducts']);
Route::get('data-penjualan/load', [ProductController::class, 'rentangPenjualan']);

Route::get('/hargapasar', function () {
    return view('HargaPasarPage');
})->name('hargapasar');

Route::get('/produk', function () {
    return view('ProdukPage');
})->name('produk');

Route::post('/logout', [AuthController::class, 'logout'])->name('profile.logout');

Route::get('/addProduct', function () {
    return view('petani.addProduct');
})->name('addProduct');

Route::get('/products/get-by-category/{category}', [ProductController::class, 'getProductsByCategory']);

Route::get('/products/{product:slug}', function (Product $product) {
    return view('DetailProductPage', compact('product'));
})->name('DetailProductPage');

Route::get('/PembayaranPage', function () {
    return view('pembeli.PembayaranPage');
})->name('PembayaranPage');

// Edit Produk
Route::get('/product/{product}/edit', [ProductController::class, 'edit'])->name('product.edit');
Route::put('/product/update/{product}', [ProductController::class, 'update'])->name('product.update');

// Hapus Produk
Route::delete('/product/delete', [ProductController::class, 'destroy'])->name('product.destroy');

Route::get('/DetailPembelianPage', function () {
    return view('pembeli.DetailPembelianPage');
})->name('DetailPembelianPage');

Route::get('/search', [SearchController::class, 'search'])->name('search');

Route::get('/chat', function () {
    return view('ChatPage');
})->name('ChatPage');

Route::view('/coba', 'coba');

Route::get('/EditHargaPasar', function () {
    return view('admin.EditHargaPasar');
})->name('EditHargaPasar');

Route::get('/MelihatHargaPasar', function () {
    return view('petani.MelihatHargaPasar');
})->name('MelihatHargaPasar');