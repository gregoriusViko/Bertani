<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\HargaPasarController;
use App\Livewire\Counter;

// rute yang hanya diakses admin
Route::middleware('auth:admin')->group(
    function () {
        Route::prefix('admin')->group(function () {
            Route::get('/laporan', [ReportController::class, 'index']);
            Route::get('showImage/{id}', [ReportController::class, 'showImage']);
            Route::prefix('delete-akun')->group(function () {
                Route::view('/', 'admin.DeleteAkun')->name('DeleteAkun');
                Route::get('/detail', [AuthController::class, 'detailAkun']);
                Route::delete('/destroy/{role}', [AuthController::class, 'deleteAkun'])->name('deleteAkun');
            });
            // Rute untuk edit harga pasar
            Route::get('/edit-harga-pasar', [HargaPasarController::class, 'editHargaPasar'])->name('admin.editHargaPasar');
            Route::post('/update-harga-pasar', [HargaPasarController::class, 'updateHargaPasar'])->name('admin.updateHargaPasar');
            Route::get('/products/get-by-category/{category}', [HargaPasarController::class, 'getProductsByCategory']);
        });
    }
);