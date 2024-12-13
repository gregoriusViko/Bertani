<?php

use App\Livewire\Counter;
use App\Models\ReportDetail;
use App\Livewire\DaftarLaporan;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\HargaPasarController;

// rute yang hanya diakses admin
Route::middleware('auth:admin')->group(
    function () {
        Route::prefix('admin')->group(function () {
            Route::get('/laporan', DaftarLaporan::class);
            Route::get('showImage/{id}', [ReportController::class, 'showImage']);
            Route::prefix('delete-akun')->group(function () {
                Route::view('/', 'admin.DeleteAkun')->name('DeleteAkun');
                Route::get('/detail', [AuthController::class, 'detailAkun']);
                Route::delete('/destroy/{role}', [AuthController::class, 'deleteAkun'])->name('deleteAkun');
            });
            // Rute untuk edit harga pasar
            Route::get('/harga-pasar', [HargaPasarController::class, 'HargaPasar'])->name('admin.HargaPasar');
            Route::get('/edit-harga-pasar', [HargaPasarController::class, 'editHargaPasar'])->name('admin.editHargaPasar');
            Route::post('/update-harga-pasar', [HargaPasarController::class, 'updateHargaPasar'])->name('admin.updateHargaPasar');
            Route::get('/products/get-by-category/{category}', [HargaPasarController::class, 'getProductsByCategory']);

            Route::get('cobacoba/{file}', function(ReportDetail $file){
    
                // Pastikan hanya pemilik file yang bisa download
                // if ($file->user_id !== Auth::id()) {
                //     abort(403, 'Unauthorized access');
                // }
                // Ambil konten gambar
            
                $mimeType = Storage::mimeType($file->img);
                $contents = Storage::get($file->img);
                    
                // Kembalikan response gambar
                return response($contents)->header('Content-Type', $mimeType);
            });
        });
    }
);