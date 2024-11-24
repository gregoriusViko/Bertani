<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ReportController;

// rute yang hanya diakses admin
Route::middleware('auth:admin')->group(
    function () {
        Route::prefix('admin')->group(function () {
            Route::get('/laporan', [ReportController::class, 'index']);
            Route::get('showImage/{id}', [ReportController::class, 'showImage']);
            Route::prefix('delete-akun')->group(function () {
                Route::view('/', 'admin.DeleteAkun')->name('DeleteAkun');
                Route::get('/detail', [AuthController::class, 'detailAkun']);
                Route::get('/destroy/{email}', [AuthController::class, 'deleteAkun']);
            });
        });
    }
);
