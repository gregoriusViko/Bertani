<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OrderController;
// rute yang hanya diakses pembeli
Route::middleware(['auth:buyer', 'verified'])->group(function(){
    Route::prefix('pembeli')->group(function(){
        Route::get('/DafPesananPembeli', function () {
            return view('pembeli.PemDafPesananPage');
        })->name('PemDafPesananPage');

        Route::get('/DafPesananPembeli', [OrderController::class, 'daftarOrderPem'])->name('DafPesananPembeli');
    });
});