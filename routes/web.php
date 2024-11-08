<?php
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Middleware\BlockAccess;
use App\Http\Middleware\BlockLogin;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReportController;
use App\Http\Middleware\AuthAdmin;

// Route::get('/', function () {
//     return view('welcome');
// });

#untuk calon user

Route::middleware(BlockAccess::class)->group(function(){
    Route::get('/profile', function () {
        return view('ProfilePage');
    })->name('profile');

    Route::get('/chat', function () {
        return view('ChatPage');
    })->name('chat');

        // // Rute untuk menampilkan halaman profil
        Route::get('/profile', [ProfileController::class, 'profile'])->name('profile');

        // Rute untuk memperbarui profil
        Route::post('/profile/update', [ProfileController::class, 'updates'])->name('profile.update');

        Route::middleware(AuthAdmin::class)->group(
            function(){
                Route::prefix('admin')->group(function(){
                    Route::resource('laporan', ReportController::class);
                    Route::get('hapus-akun/detail/{id}', [AuthController::class, 'hapusAkun']);
                });
            }
        );
});

Route::middleware(BlockLogin::class)->group(
    function(){
    Route::get('/register', [AuthController::class, 'tampilRegister'])->name('register.tampil');
    Route::post('/register/submit',[AuthController::class, 'submitRegister'])->name('register.submit');

    Route::get('/login', [AuthController::class, 'tampilLogin'])->name('login.tampil');
    Route::post('/login/submit',[AuthController::class, 'submitLogin'])->name('login.proses');
    }
);

Route::get('/', [ProductController::class, 'home'])->name('HomePageDefault');
Route::get('/products/load', [ProductController::class, 'loadMoreProducts']);

Route::get('/hargapasar', function () {
    return view('HargaPasarPage');
})->name('hargapasar');

Route::get('/produk', function () {
    return view('ProdukPage');
})->name('produk');

Route::get('/pesanan', function () {
    return view('PesananPage');
})->name('pesanan');

Route::get('/lapPen', function () {
    return view('PetLaporanPenjualanPage');
})->name('lapPen');

Route::get('/dafproduk', function () {
    return view('PetDafProdPage');
})->name('dafproduk');

Route::get('/dafpesanan', function () {
    return view('PetDafPesananPage');
})->name('dafpesanan');

Route::get('/laporanpage', function () {
    return view('LaporanPage');
})->name('laporanpage');

Route::post('/logout', [AuthController::class, 'logout'])->name('profile.logout');