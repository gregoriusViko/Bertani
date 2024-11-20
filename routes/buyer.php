<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
// rute yang hanya diakses pembeli
Route::middleware(['auth:buyer', 'verified'])->group(function(){
    Route::prefix('pembeli')->group(function(){
        Route::get('/DafPesananPembeli', function () {
            return view('pembeli.PemDafPesananPage');
        })->name('PemDafPesananPage');
        Route::get('/pesanan', function () {
            $buyer = Auth::guard('buyer')->user();
            $order = $buyer->orders;
            return view('pembeli.PemDafPesananPage', compact('order'));
        })->name('pesanan');
    });
});