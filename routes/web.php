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
use App\Http\Controllers\Auth\VerificationController;
use App\Http\Controllers\NotificationController;

// ===================================================================
//                              LANDING PAGE
// ===================================================================

Route::get('/', function () {
    return view('landing');
})->name('landing');

Route::get('/about_us', function () {
    return view('about_us');
})->name('about_us');

// ===================================================================
//                              AUTH
// ===================================================================

Route::get('/auth/redirect', [SocialiteController::class, 'redirect'])->name('google.redirect');
Route::get('/auth/google/callback', [SocialiteController::class, 'callback']);

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');

Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::post('/register', [AuthController::class, 'register'])->name('register.post');

Route::post('/logout', [AuthController::class, 'logout'])->name('logout.post');

// ===================================================================
//                              EMAIL
// ===================================================================

Route::get('/email/verify', [VerificationController::class, 'show'])->name('verification.notice');

Route::post('/email/verify', [VerificationController::class, 'verify'])->name('verification.verify');

// ===================================================================
//                           HALAMAN CUSTOMER
// ===================================================================

Route::prefix('customer')->name('customer.')->group(function () {

    Route::get('/dashboard', [CustomerOrderController::class, 'dashboard'])
        ->middleware(['auth', 'verified'])
        ->name('dashboard');

    Route::middleware(['auth', 'verified'])->group(function () {

        Route::get('/order-status', [CustomerOrderController::class, 'status'])
            ->name('order.status');

        Route::get('/history', [CustomerOrderController::class, 'history'])
            ->name('history');

        Route::get('/notifications', [NotificationController::class, 'index'])
            ->name('notifications');

        Route::get('/profile', [CustomerProfileController::class, 'edit'])
            ->name('profile.edit');

        Route::patch('/profile', [CustomerProfileController::class, 'update'])
            ->name('profile.update');
    });

    Route::get('/order', [CustomerOrderController::class, 'create'])
        ->middleware(['auth', 'verified', 'profile.complete'])
        ->name('order.create');

    Route::post('/order', [CustomerOrderController::class, 'store'])
        ->middleware(['auth', 'verified'])
        ->name('order.store');

    Route::get('/feedback/create/{orderId}', [FeedbackController::class, 'create'])
        ->middleware(['auth', 'verified'])
        ->name('feedback.create');

    Route::post('/feedback', [FeedbackController::class, 'store'])
        ->middleware(['auth', 'verified'])
        ->name('feedback.store');

    Route::get('/order/payment/{order}', [CustomerOrderController::class, 'payment'])
        ->middleware(['auth', 'verified'])
        ->name('order.payment');

    Route::get('/order/{order}/track', [CustomerOrderController::class, 'track'])
        ->middleware(['auth', 'verified'])
        ->name('order.track');
});

// ===================================================================
//                           HALAMAN WORKER 
// ===================================================================
Route::prefix('worker')->name('worker.')->middleware(['auth', 'is_worker'])->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('/pesanan-aktif', [WorkerOrderController::class, 'activeOrders'])->name('pesanan-actived.active');

    Route::get('/riwayat-pesanan', [OrderHistoryController::class, 'index'])->name('history-pesanan');

    Route::get('/profil', [WorkerProfileController::class, 'show'])->name('profil.show');

    Route::put('/profil', [WorkerProfileController::class, 'update'])->name('profil.update');

    Route::get('/location-chart', fn() => view('worker.location-chart'))->name('location.chart');

    Route::get('/notifications', [NotificationController::class, 'index'])->name('notifications');

    Route::post('/logout', [DashboardController::class, 'destroy'])->name('logout');

    Route::post('/status/toggle', [DashboardController::class, 'toggleActiveStatus'])->name('status.toggle');

    Route::post('/orders/{order}/update-status', [DashboardController::class, 'updateOrderStatus'])->name('order.updateStatus');

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
        Route::get('/', 'index')->name('index');
        Route::get('/tambah', 'create')->name('tambah');
        Route::post('/', 'store')->name('store');
        Route::get('/{service}/edit', 'edit')->name('edit');
        Route::put('/{service}', 'update')->name('update');
        Route::delete('/{service}', 'destroy')->name('destroy');
    });

    Route::resource('promo', PromoController::class)->except(['show']);

    Route::prefix('announcement')->name('announcement.')->controller(AnnouncementController::class)->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/tambah', 'create')->name('tambah');
        Route::post('/', 'store')->name('store');
        Route::get('/{announcement}/edit', 'edit')->name('edit');
        Route::put('/{announcement}', 'update')->name('update');
        Route::delete('/{announcement}', 'destroy')->name('destroy');
    });

    Route::prefix('pesanan')->name('pesanan.')->controller(OrderController::class)->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/{order}', 'show')->name('show');
        Route::post('/{order}/update-status', 'updateStatus')->name('updateStatus');
    });

    Route::get('/peraturan', [AdminDashboardController::class, 'peraturan'])->name('peraturan.index');
});

// ===================================================================
//                              NOTIFIKASI
// ===================================================================

Route::middleware(['auth'])->group(function () {
    Route::get('/notifications/fetch', [NotificationController::class, 'fetch'])->name('notifications.fetch');
    Route::post('/notifications/mark-read', [NotificationController::class, 'markAllAsRead'])->name('notifications.markAsRead');
});


// ===================================================================
//                             Midtrans
// ===================================================================

Route::post('/midtrans/callback', [MidtransCallbackController::class, 'notificationHandler']);
