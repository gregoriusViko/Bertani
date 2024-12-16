<?php
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\HargaPasarController;

require base_path('routes/admin.php');
require base_path('routes/buyer.php');
require base_path('routes/farmer.php');
require base_path('routes/auth.php');

Route::get('/', [ProductController::class, 'home'])->name('HomePageDefault');
Route::get('/products/load', [ProductController::class, 'loadMoreProducts']);
Route::get('data-penjualan/load', [ProductController::class, 'rentangPenjualan']);

Route::view('/hargapasar', 'HargaPasarPage')->name('hargapasar');

Route::view('/produk','ProdukPage')->name('produk');

Route::post('/logout', [AuthController::class, 'logout'])->name('profile.logout');

Route::view('/addProduct', 'petani.addProduct')->name('addProduct');

Route::get('/products/get-by-category/{category}', [ProductController::class, 'getProductsByCategory']);

Route::get('/products/{product:slug}', function (Product $product) {
    return view('DetailProductPage', compact('product'));
})->name('DetailProductPage');

Route::view('/PembayaranPage','pembeli.PembayaranPage')->name('pembeli.PembayaranPage');

// Hapus Produk
Route::delete('/product/delete', [ProductController::class, 'destroy'])->name('product.destroy');

Route::get('/search', [SearchController::class, 'search'])->name('search');
Route::get('/search/load', [SearchController::class, 'loadMoreProducts'])->name('search-load');

Route::view('/EditHargaPasar', 'admin.EditHargaPasar')->name('EditHargaPasar');

Route::view('/hargapasar', 'MelihatHargaPasar')->name('hargapasar');

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

Route::post('/orders/{order}/reject', [OrderController::class, 'reject'])->name('orders.reject');

Route::get('/orders/{orderId}/confirm', [OrderController::class, 'showConfirmModal'])->name('orders.confirm');

Route::get('/order/showConfirmModal/{orderId}', [OrderController::class, 'showConfirmModal']);
Route::post('/order/acceptOrder/{orderId}', [OrderController::class, 'acceptOrder']);


Route::patch('/orders/{orderId}/accept', [OrderController::class, 'acceptOrder'])
    ->name('orders.accept')
    ->middleware('auth:farmer');

Route::get('/order/payment/{orderId}', [OrderController::class, 'showPaymentPage'])->name('order.showPaymentPage');

Route::post('/order/finish/{orderId}', [OrderController::class, 'finishOrder'])->name('order.finish');

