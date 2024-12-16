<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OrderController;
// rute yang hanya diakses pembeli
Route::middleware(['auth:buyer', 'verified'])->group(function(){
    Route::prefix('pembeli')->group(function(){
        Route::get('/DafPesananPembeli', [OrderController::class, 'daftarOrderPem'])->name('DafPesananPembeli');
        Route::get('/order/{orderId}/pembayaran',[OrderController::class, 'showPaymentPage'])->name('pembeli.PembayaranPage');
        Route::get('/order/{order:receipt_number}/detail', [OrderController::class, 'showDetailPembelian'])->name('DetailPembelianPage');
        Route::patch('/order/{order:receipt_number}/cancel-order',[OrderController::class, 'cancelOrder'])->name('order.cancel');

        Route::get('/order/payment/{orderId}', [OrderController::class, 'showPaymentPage'])->name('order.showPaymentPage');

        Route::post('/order/finish/{orderId}', [OrderController::class, 'finishOrder'])->name('order.finish');
    });
});