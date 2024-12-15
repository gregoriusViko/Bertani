<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
// rute yang hanya diakses petani
Route::middleware(['auth:farmer', 'verified'])->group(function () {
    Route::prefix('petani')->group(function(){
        Route::controller(ProductController::class)->group(function () {
            Route::get('/dafproduk', 'farmerProducts')->name('dafproduk');
            Route::get('/products/create', 'create')->name('products.create');
            Route::post('products/Toko', 'Toko')->name('products.Toko');
            Route::get('/lapPen', 'laporanPenjualan')->name('lapPen');
    
            // Edit Produk
            Route::get('/product/{product:slug}/edit', 'edit')->name('product.edit');
            Route::put('/product/update/{product:slug}', 'update')->name('product.update');
        });
    
        Route::get('/dafpesanan', [OrderController::class, 'daftarOrder'])->name('dafpesanan');
        Route::get('/dafpesanan/{order:receipt_number}', [OrderController::class, 'detailOrder'])->name('detailpesanan');
    });
});
