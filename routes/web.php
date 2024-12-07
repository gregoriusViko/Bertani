<?php
use App\Events\Typing;
use App\Models\Product;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\HargaPasarController;
use App\Models\Farmer;
use App\Models\Order;

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
})->name('pembeli.PembayaranPage');

// Hapus Produk
Route::delete('/product/delete', [ProductController::class, 'destroy'])->name('product.destroy');

// Route::get('/DetailPembelianPage/{id}', function (Order $id) {
//     return view('pembeli.DetailPembelianPage');
// })->name('DetailPembelianPage');


Route::get('/PemDafPesananPage', function () {
    return view('pembeli.PemDafPesananPage');
})->name('PemDafPesananPage');

Route::get('/search', [SearchController::class, 'search'])->name('search');

Route::view('/coba', 'coba');

Route::get('/EditHargaPasar', function () {
    return view('admin.EditHargaPasar');
})->name('EditHargaPasar');

Route::get('/hargapasar', function () {
    return view('MelihatHargaPasar');
})->name('hargapasar');

Route::get('/chatroom', function () {
    return view('ChatPage');
})->name('ChatPage');


Route::post('/order/store', [OrderController::class, 'store'])->name('order.store');
Route::get('/order/{orderId}/pembayaran',[OrderController::class, 'showPaymentPage'])->name('pembeli.PembayaranPage');

// Halaman untuk mengedit harga pasar
Route::get('/edit-harga-pasar', [HargaPasarController::class, 'editHargaPasar'])
    ->name('admin.editHargaPasar');

// Endpoint untuk memperbarui harga pasar
Route::post('/update-harga-pasar', [HargaPasarController::class, 'updateHargaPasar'])
    ->name('admin.updateHargaPasar');

// Endpoint untuk mengambil produk berdasarkan kategori
Route::get('/products/get-by-category/{category}', [HargaPasarController::class, 'getProductsByCategory']);

Route::get('/melihat-harga-pasar', [HargaPasarController::class, 'melihatHargaPasar'])->name('MelihatHargaPasar');

Route::get('/order/{order}/detail', [OrderController::class, 'showDetailPembelian'])->name('DetailPembelianPage');

Route::patch('/order/{order}/cancel-order',[OrderController::class, 'cancelOrder'])->name('order.cancel');

Route::get('/product/{id}', [ProductController::class, 'show'])->name('product.show');
