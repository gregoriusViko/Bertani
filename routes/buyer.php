<?php

use Illuminate\Support\Facades\Route;
// rute yang hanya diakses pembeli
Route::middleware(['auth:buyer', 'verified'])->group(function(){
    Route::prefix('pembeli')->group(function(){
        Route::get('/DafPesananPembeli', function () {
            return view('pembeli.PemDafPesananPage');
        })->name('PemDafPesananPage');
    });
});