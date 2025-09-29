<?php

use App\Http\Controllers\Auth\SocialiteController;
use App\Http\Controllers\Customer\ProfileController;
use App\Http\Controllers\Customer\OrderController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\MidtransCallbackController;
use App\Http\Controllers\Auth\AuthController;

// ===================================================================
// HALAMAN PUBLIK & OTENTIKASI
// ===================================================================
Route::get('/', function () {
    return view('landing');
})->name('landing');

Route::get('/about_us', function () {
    return view('about_us');
})->name('about_us');

// Form Login & Register (GET)
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');

// Proses Login & Register (POST)
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::post('/register', [AuthController::class, 'register'])->name('register.post');

// Logout
Route::post('/logout', [AuthController::class, 'logout'])->name('logout.post');

// ===================================================================
//                              EMAIL
// ===================================================================

Route::get('/email/verify', function () {
    return view('auth.verify');
})->middleware('auth')->name('verification.notice');

Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();
    return redirect('customer/dashboard');
})->middleware(['auth', 'signed'])->name('verification.verify');

Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();
    return back()->with('resent', 'Link verifikasi baru telah dikirimkan ke alamat email Anda.');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');

// ===================================================================
//                           HALAMAN CUSTOMER
// ===================================================================

Route::prefix('customer')->name('customer.')->group(function () {

    Route::get('/dashboard', function () {
        view()->share('user', (object)['name' => 'Aditya']);
        return view('customer.dashboard');
    })->middleware(['auth', 'verified'])->name('dashboard');


    // page order
    Route::get('/order', [OrderController::class, 'create'])
        ->middleware(['auth', 'verified', 'profile.complete']) // Penjaga: hanya user yang sudah login yang bisa lewat.
        ->name('order.create'); // Kita beri nama 'order.create' agar mudah dipanggil.

    // Rute ini untuk MEMPROSES data form saat tombol submit ditekan (metode POST).
    Route::post('/order', [OrderController::class, 'store'])
        ->middleware(['auth', 'verified'])
        ->name('order.store');

    Route::get('/order/payment/{order}', [OrderController::class, 'payment'])
        ->middleware(['auth', 'verified'])
        ->name('order.payment');

    Route::middleware(['auth', 'verified'])->group(function () {
        Route::get('/order-status', [OrderController::class, 'status'])
            ->name('order.status');
    });

    Route::get('/locations', function () {
        return view('customer.locations');
    })->middleware(['auth', 'verified'])->name('locations');

    Route::get('/tracking/{order}', function ($orderId) {
        return view('customer.tracking');
    })->middleware(['auth', 'verified'])->name('tracking');

    Route::get('/history', function () {
        return view('customer.history');
    })->middleware(['auth', 'verified'])->name('history');

    Route::get('/notifications', function () {
        return view('customer.notifications');
    })->middleware(['auth', 'verified'])->name('notifications');

    Route::get('/feedback', function () {
        return view('customer.feedback');
    })->middleware(['auth', 'verified'])->name('feedback.create');

    // page profile

    Route::get('/profile', [ProfileController::class, 'edit'])
        ->middleware(['auth', 'verified'])
        ->name('profile.edit');

    Route::patch('/profile', [ProfileController::class, 'update'])
        ->middleware(['auth', 'verified'])
        ->name('profile.update');
});

// ===================================================================
//                           HALAMAN WORKER 
// ===================================================================
Route::prefix('worker')->name('worker.')->group(function () {

    // Halaman Dashboard Utama
    Route::get('/dashboard', function () {
        return view('worker.dashboard');
    })->name('dashboard');

    // Halaman Pesanan Aktif
    Route::get('/pesanan-actived', function () {
        return view('worker.pesanan-actived');
    })->name('pesanan.actived');

    // Halaman Riwayat Pesanan
    Route::get('/history-pesanan', function () {
        return view('worker.history-pesanan');
    })->name('pesanan.history');

    // Halaman Grafik Lokasi
    Route::get('/location-chart', function () {
        return view('worker.location-chart');
    })->name('location.chart');

    // Halaman Notifikasi
    Route::get('/notifications', function () {
        return view('worker.notifications');
    })->name('notifications');

    // Halaman Profil Worker
    Route::get('/profil', function () {
        return view('worker.profil');
    })->name('profil');
});

// ===================================================================
//                           HALAMAN ADMIN
// ===================================================================
Route::prefix('admin')->name('admin.')->group(function () {

    // Halaman Dashboard Utama
    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    })->name('dashboard');

    Route::get('/worker/index', function () {
        return view('admin.worker.index');
    })->name('worker.index');

    Route::get('/worker/location-chart', function () {
        return view('admin.worker.location-chart');
    })->name('worker.location-chart');

    Route::get('/worker/tambah', function () {
        return view('admin.worker.tambah');
    })->name('worker.tambah');

    Route::get('/worker/edit', function () {
        return view('admin.worker.edit');
    })->name('worker.edit');

    Route::get('/customer/index', function () {
        return view('admin.customer.index');
    })->name('customer.index');

    Route::get('/customer/edit', function () {
        return view('admin.customer.edit');
    })->name('customer.edit');

    Route::get('/pesanan', function () {
        return view('admin.pesanan');
    })->name('pesanan');
});

// ===================================================================
//                          Authentication
// ===================================================================

Route::get('/auth/redirect', [SocialiteController::class, 'redirect'])->name('google.redirect');
Route::get('/auth/google/callback', [SocialiteController::class, 'callback']);

// ===================================================================
//                             Midtrans
// ===================================================================
Route::post('/midtrans/callback', [MidtransCallbackController::class, 'notificationHandler']);
