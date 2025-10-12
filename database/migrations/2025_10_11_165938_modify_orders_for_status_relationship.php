<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            // 1. Hapus kolom 'status' yang lama
            $table->dropColumn('status');

            // 2. Tambahkan kolom foreign key 'status_id'
            // Ini akan terhubung ke kolom 'id' di tabel 'statuses'
            $table->foreignId('status_id')->nullable()->after('total_price')->constrained('statuses');
        });
    }

    public function down(): void // Untuk rollback jika terjadi error
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropForeign(['status_id']);
            $table->dropColumn('status_id');
            $table->string('status')->default('pending'); // Kembalikan kolom lama
        });
    }
};
