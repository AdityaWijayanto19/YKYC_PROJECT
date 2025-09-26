<?php

use App\Http\Controllers\Auth\SocialiteController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\Auth\AuthController;

// ===================================================================
// HALAMAN PUBLIK & OTENTIKASI
// ===================================================================
Route::get('/', function () {
    return view('landing');
})->name('landing');

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

    Route::get('/order', function () {
        return view('customer.order');
    })->middleware(['auth', 'verified'])->name('order.create');

    Route::get('/order-status', function () {
        return view('customer.order_status');
    })->middleware(['auth', 'verified'])->name('order.status');

    Route::get('/locations', function () {
        $all_active_locations = [
            ['worker' => 'Gerobak Senayan Park', 'location' => ['lat' => -6.2297, 'lng' => 106.8093]],
            ['worker' => 'Gerobak Stasiun Gambir', 'location' => ['lat' => -6.1751, 'lng' => 106.8650]],
            ['worker' => 'Gerobak Blok M Square', 'location' => ['lat' => -6.2415, 'lng' => 106.8242]]
        ];

        return view('customer.locations', ['active_locations' => $all_active_locations]);
    })->middleware(['auth', 'verified'])->name('locations');

    Route::get('/tracking/{order}', function ($orderId) {

        $all_orders_database = [
            'YKYC-221' => [
                'order_id' => 'YKYC-221',
                'worker' => 'Gerobak Senayan Park',
                'status' => 'In Progress',
                'location' => ['lat' => -6.2297, 'lng' => 106.8093]
            ],
            'YKYC-215' => [
                'order_id' => 'YKYC-215',
                'worker' => 'Gerobak Stasiun Gambir',
                'status' => 'Ready for Pickup',
                'location' => ['lat' => -6.1751, 'lng' => 106.8650]
            ],
            'YKYC-209' => [
                'order_id' => 'YKYC-209',
                'worker' => 'Worker Keliling - Budi',
                'status' => 'In Progress',
                'location' => ['lat' => -6.2415, 'lng' => 106.8242]
            ]
        ];

        $tracked_order = $all_orders_database[$orderId] ?? null;

        $data_to_send = [];

        if ($tracked_order) {
            $data_to_send[] = $tracked_order;
        }

        return view('customer.tracking', ['tracked_orders' => $data_to_send]);
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
        $active_locations = [
            ['worker' => 'Budi Santoso', 'location' => ['lat' => -6.2088, 'lng' => 106.8456]],
            ['worker' => 'Ahmad Fauzi', 'location' => ['lat' => -6.2297, 'lng' => 106.809]],
            ['worker' => 'Eko Prasetyo', 'location' => ['lat' => -6.1751, 'lng' => 106.865]],
        ];

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
//                          ROUTE PAYMENT
// ===================================================================

Route::get('/checkout', [PaymentController::class, 'checkout']);

// ===================================================================
//                          Authentication
// ===================================================================

Route::get('/auth/redirect', [SocialiteController::class, 'redirect'])->name('google.redirect');
Route::get('/auth/google/callback', [SocialiteController::class, 'callback']);
