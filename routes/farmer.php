<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
// rute yang hanya diakses petani
Route::middleware(['auth:farmer','verified'])->group(function(){
    Route::controller(ProductController::class)->group(function(){
        Route::get('/dafproduk', 'farmerProducts')->name('dafproduk');
        Route::get('/products/create', 'create')->name('products.create');
        Route::post('products/Toko', 'Toko')->name('products.Toko');
        Route::get('/lapPen', 'laporanPenjualan')->name('lapPen');
    });

    Route::get('/dafpesanan', [OrderController::class, 'daftarOrder'])->name('dafpesanan');
});