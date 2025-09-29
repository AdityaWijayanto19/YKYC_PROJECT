<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    // File: database/migrations/...._create_orders_table.php

    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            // --- Informasi Kunci (Penghubung ke tabel lain) ---
            $table->id(); // ID unik untuk setiap pesanan, contoh: #1, #2, dst.

            // ========================================================================
            // TAMBAHKAN BARIS INI! INI ADALAH KUNCI UTAMA SOLUSINYA
            $table->string('order_id')->unique()->nullable(); // ID unik untuk Midtrans, contoh: YKYC-1-xyz
            // ========================================================================

            $table->foreignId('user_id')->constrained('users'); // Menghubungkan ke tabel 'users'. Siapa yang pesan?
            $table->foreignId('service_id')->constrained('services'); // Menghubungkan ke tabel 'services'. Pesan layanan apa?

            // --- Detail Logistik Pesanan ---
            $table->string('delivery_method'); // Akan diisi 'drop-off' atau 'pickup'
            $table->foreignId('location_id')->nullable()->constrained('locations'); // Jika 'drop-off', di gerobak mana? Dibuat nullable() karena tidak wajib diisi jika metodenya 'pickup'.
            $table->text('customer_address')->nullable(); // Jika 'pickup', alamatnya di mana? Dibuat nullable() karena tidak wajib diisi jika metodenya 'drop-off'.

            // --- Detail Keuangan ---
            $table->unsignedInteger('service_price'); // Menyimpan harga layanan pada saat order dibuat.
            $table->unsignedInteger('delivery_fee');  // Menyimpan biaya ongkir (bisa 0 jika drop-off).
            $table->unsignedInteger('total_price');   // Total yang harus dibayar customer.

            // --- Status & Pelacakan ---
            $table->string('status')->default('pending'); // Status PENGERJAAN: pending, diproses, selesai, dibatalkan.

            // --- Kolom Khusus untuk Integrasi Pembayaran Midtrans ---
            $table->string('payment_status')->default('pending'); // Status PEMBAYARAN: pending, paid (dibayar), expired, failed.
            $table->string('snap_token')->nullable(); // Untuk menyimpan token unik dari Midtrans yang akan menampilkan pop-up pembayaran.

            // Worker yang menangani (opsional saat order dibuat)
            $table->foreignId('worker_id')->nullable()->constrained('workers'); // Siapa yang mengerjakan? Dibuat nullable() karena worker bisa ditugaskan nanti, terutama untuk yang 'keliling'.

            $table->timestamps(); // Otomatis membuat kolom created_at dan updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
