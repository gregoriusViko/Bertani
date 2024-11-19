<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Request;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
// rute yang bisa diakses pengguna yang telah login
Route::middleware('auth:admin,buyer,farmer')->group(function () {
    Route::get('/chat', function () {
        return view('ChatPage');
    })->name('chat');

    // Rute untuk menampilkan halaman profil
    Route::get('/profile', [ProfileController::class, 'profile'])->name('profile');

    // Rute untuk memperbarui profil
    Route::post('/profile/update', [ProfileController::class, 'updates'])->name('profile.update');
});

//rute untuk pembeli dan petani
Route::middleware(['auth:farmer,buyer', 'verified'])->group(function () {
    Route::view('/laporan/sistem', 'PemLaporanPage')->name('laporan-sistem');
    Route::view('/laporan/pengguna', 'PetLaporanPage')->name('laporan-pengguna');
    Route::post('/laporan/sistem-create', [ReportController::class, 'createForSystem']);
});

// rute untuk orang yang belum login
Route::middleware('guest:admin,farmer,buyer')->group(
    function () {
        Route::get('/register', [AuthController::class, 'tampilRegister'])->name('register.tampil');
        Route::post('/register/submit', [AuthController::class, 'submitRegister'])->name('register.submit');

        Route::get('/login', [AuthController::class, 'tampilLogin'])->name('login');
        Route::post('/login/submit', [AuthController::class, 'submitLogin'])->name('login.proses');
    }
);

Route::get('email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();

    return redirect('/');
})->middleware(['auth:buyer,farmer'])->name('verification.verify');

Route::get('/email/verify', function () {
    return view('auth.verifikasi');
})->middleware('auth:buyer,farmer')->name('verification.notice');

Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();
 
    return back()->with('message', 'Verification link sent!');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');
