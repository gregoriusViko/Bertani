<?php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use Illuminate\Container\Attributes\Auth;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;

// rute yang bisa diakses pengguna yang telah login
Route::middleware('auth:admin,buyer,farmer')->group(function(){
    Route::get('/chat', function () {
        return view('ChatPage');
    })->name('chat');

        // // Rute untuk menampilkan halaman profil
        Route::get('/profile', [ProfileController::class, 'profile'])->name('profile');

        // Rute untuk memperbarui profil
        Route::post('/profile/update', [ProfileController::class, 'updates'])->name('profile.update');
});

// rute yang hanya diakses admin
Route::middleware('auth:admin')->group(
    function(){
        Route::prefix('admin')->group(function(){
            Route::resource('laporan', ReportController::class);
            Route::get('detail-petani/{farmer:slug}', [AuthController::class, 'detailAkun']);
            Route::get('delete/{farmer:slug}', [AuthController::class, 'deleteAkun']);
        });
    }
);

// rute yang hanya diakses petani
Route::middleware(['auth:farmer','verified'])->group(function(){
    Route::get('dafproduk', [ProductController::class, 'farmerProducts'])->name('dafproduk');

    Route::get('/dafpesanan', function () {
        return view('petani.PetDafPesananPage');
    })->name('dafpesanan');

    Route::get('/lapPen', function () {
        return view('petani.PetLaporanPenjualanPage');
    })->name('lapPen');

    Route::get('products/create', [ProductController::class, 'create'])->name('products.create');

    Route::post('products/Toko', [ProductController::class, 'Toko'])->name('products.Toko');
});

// rute yang hanya diakses pembeli
Route::middleware(['auth:buyer', 'verified'])->group(function(){
    Route::get('pembeli/coba', function(){
        return 'berhasil pembeli';
    });
});

// rute untuk orang yang belum login
Route::middleware('guest:admin,farmer,buyer')->group(
    function(){
    Route::get('/register', [AuthController::class, 'tampilRegister'])->name('register.tampil');
    Route::post('/register/submit',[AuthController::class, 'submitRegister'])->name('register.submit');

    Route::get('/login', [AuthController::class, 'tampilLogin'])->name('login');
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

Route::get('/laporan', function () {
    return view('LaporanPage');
})->name('laporan');

Route::post('/logout', [AuthController::class, 'logout'])->name('profile.logout');

Route::get('/addProduct', function () {
    return view('petani.addProduct');
})->name('addProduct');

Route::get('email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();
 
    return redirect('/');
})->middleware(['auth:buyer,farmer'])->name('verification.verify');

Route::get('/email/verify', function () {
    return 'verifikasi dulu dong';
})->middleware('auth:buyer,farmer')->name('verification.notice');

Route::get('/laporan', function () {
    return view('PemLaporanPage');
})->name('laporan');

Route::get('/DetailProductPage', function () {
    return view('DetailProductPage');
})->name('DetailProductPage');