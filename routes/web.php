<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

use App\Http\Controllers\MidtransCallbackController;

use App\Http\Controllers\Auth\SocialiteController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use App\Http\Controllers\Auth\AuthController;

use App\Http\Controllers\Customer\FeedbackController;
use App\Http\Controllers\Customer\ProfileController as CustomerProfileController;
use App\Http\Controllers\Customer\OrderController as CustomerOrderController;

use App\Http\Controllers\Worker\DashboardController;
use App\Http\Controllers\Worker\OrderController as WorkerOrderController;
use App\Http\Controllers\Worker\OrderHistoryController;
use App\Http\Controllers\Worker\ProfileController as WorkerProfileController;

use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\AnnouncementController;
use App\Http\Controllers\Admin\CustomerManagementController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\PromoController;
use App\Http\Controllers\Admin\WorkerManagementController;
use App\Http\Controllers\Admin\ServiceController;

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

    Route::get('/dashboard', [CustomerOrderController::class, 'dashboard'])
        ->middleware(['auth', 'verified'])
        ->name('dashboard');

    // page order
    Route::get('/order', [CustomerOrderController::class, 'create'])
        ->middleware(['auth', 'verified', 'profile.complete']) // Penjaga: hanya user yang sudah login yang bisa lewat.
        ->name('order.create'); // Kita beri nama 'order.create' agar mudah dipanggil.

    // Rute ini untuk MEMPROSES data form saat tombol submit ditekan (metode POST).
    Route::post('/order', [CustomerOrderController::class, 'store'])
        ->middleware(['auth', 'verified'])
        ->name('order.store');

    Route::get('/order/payment/{order}', [CustomerOrderController::class, 'payment'])
        ->middleware(['auth', 'verified'])
        ->name('order.payment');

    Route::middleware(['auth', 'verified'])->group(function () {
        Route::get('/order-status', [CustomerOrderController::class, 'status'])
            ->name('order.status');
    });

    Route::get('/order/{order}/track', [CustomerOrderController::class, 'track'])
        ->middleware(['auth', 'verified'])
        ->name('order.track');

    Route::middleware(['auth', 'verified'])->group(function () {
        Route::get('/history', [CustomerOrderController::class, 'history'])
            ->name('history');
    });

    Route::get('/notifications', function () {
        return view('customer.notifications');
    })->middleware(['auth', 'verified'])->name('notifications');

    Route::get('/feedback/create/{orderId}', [FeedbackController::class, 'create'])
        ->middleware(['auth', 'verified'])
        ->name('feedback.create');

    Route::post('/feedback', [FeedbackController::class, 'store'])
        ->middleware(['auth', 'verified'])
        ->name('feedback.store');

    // page profile

    Route::get('/profile', [CustomerProfileController::class, 'edit'])
        ->middleware(['auth', 'verified'])
        ->name('profile.edit');

    Route::patch('/profile', [CustomerProfileController::class, 'update'])
        ->middleware(['auth', 'verified'])
        ->name('profile.update');
});

// ===================================================================
//                           HALAMAN WORKER 
// ===================================================================
Route::prefix('worker')->name('worker.')->middleware(['auth', 'is_worker'])->group(function () {

    // === RUTE HALAMAN (VIEWS) ===

    // Halaman Dashboard Utama -> Ditangani oleh DashboardController@index
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Halaman Pesanan Aktif -> Ditangani oleh WorkerOrderController
    Route::get('/pesanan-aktif', [WorkerOrderController::class, 'activeOrders'])->name('pesanan-actived.active');

    // Halaman Riwayat Pesanan -> Ditangani oleh WorkerOrderController
    Route::get('/riwayat-pesanan', [OrderHistoryController::class, 'index'])->name('history-pesanan');

    // Halaman Profil Worker
    Route::get('/profil', [WorkerProfileController::class, 'show'])->name('profil.show');

    Route::put('/profil', [WorkerProfileController::class, 'update'])->name('profil.update');

    // (Rute untuk 'location-chart' dan 'notifications' bisa ditambahkan controllernya nanti)
    Route::get('/location-chart', fn() => view('worker.location-chart'))->name('location.chart');
    Route::get('/notifications', fn() => view('worker.notifications'))->name('notifications');

    Route::post('/logout', [DashboardController::class, 'destroy'])->name('logout');

    // === RUTE AKSI (UNTUK AJAX & FORM) ===

    // Aksi untuk mengubah status aktif/non-aktif
    Route::post('/status/toggle', [DashboardController::class, 'toggleActiveStatus'])->name('status.toggle');

    // Aksi untuk mengubah status pengerjaan pesanan
    Route::post('/orders/{order}/update-status', [DashboardController::class, 'updateOrderStatus'])->name('order.updateStatus');

    // Aksi untuk menerima update lokasi GPS dari worker
    Route::post('/location/update', [DashboardController::class, 'updateLocation'])->name('location.update');
});

// ===================================================================
//                           HALAMAN ADMIN
// ===================================================================
Route::prefix('admin')->name('admin.')->middleware(['auth', 'is_admin'])->group(function () {

    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');

    Route::prefix('worker')->name('worker.')->group(function () {
        Route::get('/', [WorkerManagementController::class, 'index'])->name('index');
        Route::get('/tambah', [WorkerManagementController::class, 'create'])->name('tambah');
        Route::post('/', [WorkerManagementController::class, 'store'])->name('store');
        Route::get('/{user}/edit', [WorkerManagementController::class, 'edit'])->name('edit');
        Route::put('/{user}', [WorkerManagementController::class, 'update'])->name('update');
        Route::delete('/{user}', [WorkerManagementController::class, 'destroy'])->name('destroy');
        Route::get('/location-chart', [WorkerManagementController::class, 'showLocations'])->name('location-chart');
    });

    Route::prefix('customer')->name('customer.')->group(function () {
        Route::get('/', [CustomerManagementController::class, 'index'])->name('index');
        Route::delete('/{user}', [CustomerManagementController::class, 'destroy'])->name('destroy');
        Route::post('/{user}/toggle-block', [CustomerManagementController::class, 'toggleBlock'])->name('toggleBlock');
    });

    Route::prefix('service')->name('service.')->controller(ServiceController::class)->group(function () {
        Route::get('/', 'index')->name('index'); // Halaman daftar (GET /admin/service)
        Route::get('/tambah', 'create')->name('tambah'); // Halaman form tambah (GET /admin/service/tambah)
        Route::post('/', 'store')->name('store'); // Aksi menyimpan (POST /admin/service)
        Route::get('/{service}/edit', 'edit')->name('edit'); // Halaman form edit (GET /admin/service/{id}/edit)
        Route::put('/{service}', 'update')->name('update'); // Aksi update (PUT /admin/service/{id})
        Route::delete('/{service}', 'destroy')->name('destroy'); // Aksi hapus (DELETE /admin/service/{id})
    });

    Route::resource('promo', PromoController::class)->except(['show']);

    Route::prefix('announcement')->name('announcement.')->controller(AnnouncementController::class)->group(function () {
        Route::get('/', 'index')->name('index');                           // Halaman daftar
        Route::get('/tambah', 'create')->name('tambah');                      // Halaman form tambah
        Route::post('/', 'store')->name('store');                          // Aksi menyimpan
        Route::get('/{announcement}/edit', 'edit')->name('edit');           // Halaman form edit
        Route::put('/{announcement}', 'update')->name('update');            // Aksi update
        Route::delete('/{announcement}', 'destroy')->name('destroy');       // Aksi hapus
    });

    Route::prefix('pesanan')->name('pesanan.')->controller(OrderController::class)->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/{order}', 'show')->name('show');
        Route::post('/{order}/update-status', 'updateStatus')->name('updateStatus');
    });

     Route::get('/peraturan', [AdminDashboardController::class, 'peraturan'])->name('peraturan.index');
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
