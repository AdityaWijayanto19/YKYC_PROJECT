<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

// ===================================================================
// HALAMAN PUBLIK & OTENTIKASI
// ===================================================================

Route::get('/', function () {
    return view('landing');
})->name('landing');

Route::get('/login', function () {
    return view('auth.login');
})->name('login');

Route::get('/register', function () {
    return view('auth.register');
})->name('register');


// ===================================================================
// HALAMAN CUSTOMER (AKSES LANGSUNG UNTUK DEVELOPMENT)
// ===================================================================

Route::prefix('customer')->name('customer.')->group(function () {

    Route::get('/dashboard', function () {
        view()->share('user', (object)['name' => 'Aditya']);
        return view('customer.dashboard');
    })->name('dashboard');

    Route::get('/order', function () {
        return view('customer.order');
    })->name('order.create');

    Route::get('/order-status', function () {
        return view('customer.order_status');
    })->name('order.status');

    // BARU: Route untuk Peta Lokasi Umum
    Route::get('/locations', function () {
        // --- SIMULASI BACKEND ---
        // Ambil SEMUA lokasi gerobak yang aktif dari database
        $all_active_locations = [
            ['worker' => 'Gerobak Senayan Park', 'location' => ['lat' => -6.2297, 'lng' => 106.8093]],
            ['worker' => 'Gerobak Stasiun Gambir', 'location' => ['lat' => -6.1751, 'lng' => 106.8650]],
            ['worker' => 'Gerobak Blok M Square', 'location' => ['lat' => -6.2415, 'lng' => 106.8242]]
        ];
        // --- AKHIR SIMULASI ---
        return view('customer.locations', ['active_locations' => $all_active_locations]);
    })->name('locations'); // Nama: customer.locations

    // routes/web.php

    // Route untuk Pelacakan Pesanan Spesifik
    Route::get('/tracking/{order}', function ($orderId) {
        // --- SIMULASI BACKEND YANG LEBIH CERDAS ---

        // 1. Definisikan "database" dummy kita
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

        // 2. "Cari" pesanan di "database" menggunakan ID dari URL ($orderId)
        // Jika ID tidak ditemukan, kembalikan null.
        $tracked_order = $all_orders_database[$orderId] ?? null;

        // 3. Siapkan array kosong untuk dikirim ke view
        $data_to_send = [];

        // 4. Jika pesanan ditemukan, masukkan ke dalam array
        if ($tracked_order) {
            $data_to_send[] = $tracked_order;
        }
        // Jika tidak ditemukan, $data_to_send akan tetap kosong, dan view akan menampilkan pesan "Tidak Ada Lokasi"

        // --- AKHIR SIMULASI ---

        // 5. Kirim data yang sudah difilter ke view
        return view('customer.tracking', ['tracked_orders' => $data_to_send]);
    })->name('tracking');

    Route::get('/history', function () {
        return view('customer.history');
    })->name('history');

    // ========== KOREKSI DI SINI ==========
    // URL, nama file view, dan nama route harus konsisten
    Route::get('/notifications', function () {
        return view('customer.notifications'); // Mengarah ke file notifications.blade.php
    })->name('notifications'); // Nama route-nya 'notifications'

    Route::get('/feedback', function () {
        return view('customer.feedback');
    })->name('feedback.create');
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
// ROUTE DUMMY UNTUK AKSI FORM
// ===================================================================

Route::post('/login', function () {
    return back()->with('message', 'Simulasi Login Berhasil!');
});

Route::post('/logout', function () {
    return redirect()->route('landing')->with('message', 'Simulasi Logout Berhasil!');
})->name('logout');
