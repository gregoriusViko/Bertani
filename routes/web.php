<?php
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

// Route::get('/', function () {
//     return view('welcome');
// });

#untuk calon user
Route::get('/', function () {
    return view('HomePageDefault');
})->name('HomePageDefault');

Route::get('/home', function () {
    return view('HomePage');
})->name('home');

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

Route::get('/chat', function () {
    return view('ChatPage');
})->name('chat');

Route::get('/laporan', function () {
    return view('LaporanPage');
})->name('laporan');

Route::get('/profile', function () {
    return view('ProfilePage');
})->name('profile');

Route::get('/register', [AuthController::class, 'tampilRegister'])->name('register.tampil');
Route::post('/register/submit',[AuthController::class, 'submitRegister'])->name('register.submit');

Route::get('/login', [AuthController::class, 'tampilLogin'])->name('login.tampil');
Route::post('/login/submit',[AuthController::class, 'submitLogin'])->name('login.proses');

// Route::middleware(['auth:buyer, farmer, admin'])->group(function() {
//     Route::post('/register/submit');
// });

Route::post('/logout', [AuthController::class, 'logout']);