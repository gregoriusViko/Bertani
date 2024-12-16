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

Route::get('/products/get-by-category/{category}', [ProductController::class, 'getProductsByCategory']);

Route::get('/products/{product:slug}', function (Product $product) {
    return view('DetailProductPage', compact('product'));
})->name('DetailProductPage');

Route::get('/search', [SearchController::class, 'search'])->name('search');
Route::get('/search/load', [SearchController::class, 'loadMoreProducts'])->name('search-load');

Route::view('/hargapasar', 'MelihatHargaPasar')->name('hargapasar');

// Endpoint untuk mengambil produk berdasarkan kategori
Route::get('/products/get-by-category/{category}', [HargaPasarController::class, 'getProductsByCategory']);

Route::get('/melihat-harga-pasar', [HargaPasarController::class, 'melihatHargaPasar'])->name('MelihatHargaPasar');

Route::get('/product/{id}', [ProductController::class, 'show'])->name('product.show');

Route::get('/orders/{orderId}/confirm', [OrderController::class, 'showConfirmModal'])->name('orders.confirm');

Route::get('/order/showConfirmModal/{orderId}', [OrderController::class, 'showConfirmModal']);
Route::post('/order/acceptOrder/{orderId}', [OrderController::class, 'acceptOrder']);


Route::patch('/orders/{orderId}/accept', [OrderController::class, 'acceptOrder'])
    ->name('orders.accept')
    ->middleware('auth:farmer');

Route::get('/order/payment/{orderId}', [OrderController::class, 'showPaymentPage'])->name('order.showPaymentPage');

Route::post('/order/finish/{orderId}', [OrderController::class, 'finishOrder'])->name('order.finish');

