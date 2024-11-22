<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ReportController;

// rute yang hanya diakses admin
Route::middleware('auth:admin')->group(
    function(){
        Route::prefix('admin')->group(function(){
            Route::get('/laporan', [ReportController::class, 'index']);
            Route::get('detail-petani/{farmer:slug}', [AuthController::class, 'detailAkun']);
            Route::get('delete/{farmer:slug}', [AuthController::class, 'deleteAkun']);
            Route::get('showImage/{id}', [ReportController::class, 'showImage']);
            Route::view('/delete-akun', 'admin.DeleteAkun')->name('DeleteAkun');
        });
    }
);