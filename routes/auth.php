<?php

use App\Livewire\Chat;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Request;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\OrderController;
use App\Http\Middleware\CheckNotVerified;
use Illuminate\Container\Attributes\Auth;
use Illuminate\Support\Facades\Broadcast;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\BroadcastingController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;

// rute yang bisa diakses pengguna yang telah login

Route::middleware('auth:admin,buyer,farmer')->group(function () {
    // Rute untuk menampilkan halaman profil
    Route::get('/profile', [ProfileController::class, 'profile'])->name('profile');
    // Rute untuk memperbarui profil
    Route::post('/profile/update', [ProfileController::class, 'updates'])->name('profile.update');

    Route::post('ganti-email', [AuthController::class, 'gantiEmail'])->name('gantiEmail');
});

//rute untuk pembeli dan petani
Route::middleware(['auth:farmer,buyer', 'verified'])->group(function () {
    Route::view('/laporan/sistem', 'PemLaporanPage')->name('laporan-sistem');
    Route::view('/laporan/pengguna', 'PetLaporanPage')->name('laporan-pengguna');
    Route::post('/laporan/sistem-create', [ReportController::class, 'createForSystem']);
    // Route::get('/chat', Chat::class)->name('ChatPage');
    Route::get('/chat/{slug?}', Chat::class)->name('chat');
    Route::get('/jumlah-chat', [AuthController::class, 'jumlahChat'])->name('sum-of-chat');
    Route::post('/order/store', [OrderController::class, 'store'])->name('order.store');

    Route::get('/laporan/{orderId}/create', [ReportController::class, 'showLaporanForm'])->name('laporan.form');
    Route::post('/laporan/submit', [ReportController::class, 'submitLaporan'])->name('laporan.submit');
});

// rute untuk orang yang belum login
Route::middleware('guest:admin,farmer,buyer')->group(
    function () {
        Route::get('/register', [AuthController::class, 'tampilRegister'])->name('register.tampil');
        Route::post('/register/submit', [AuthController::class, 'submitRegister'])->name('register.submit');

        Route::get('/login', [AuthController::class, 'tampilLogin'])->name('login');
        Route::post('/login/submit', [AuthController::class, 'submitLogin'])->name('login.proses');

        Route::view('/LupaPassword', 'auth.LupaPassword')->name('LupaPassword');

        Route::post('/forgot-password', [AuthController::class, 'sendResetLink'])->name('password.email');

        Route::get('/reset-password/{token}', [AuthController::class, 'showResetPasswordForm'])->name('password.reset');

        Route::post('/reset-password', [AuthController::class, 'resetPassword'])->name('password.update');
    }
);

Route::get('email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();

    return redirect('/');
})->middleware(['auth:buyer,farmer'])->name('verification.verify');

Route::get('/email/verify', function () {
    return view('auth.verifikasi');
})->middleware(['auth:buyer,farmer', CheckNotVerified::class])->name('verification.notice');

Route::post('/email/verification-notification', function (Request $request) {
    auth()->user()->sendEmailVerificationNotification();
 
    return back()->with('message', 'Verification link sent!');
})->middleware(['auth:buyer,farmer', 'throttle:5,1440'])->name('verification.send');
