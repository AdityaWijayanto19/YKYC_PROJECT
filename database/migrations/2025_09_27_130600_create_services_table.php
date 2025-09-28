<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('services', function (Blueprint $table) {
            $table->id(); // Membuat kolom ID unik untuk setiap layanan
            $table->string('name'); // Kolom untuk menyimpan nama layanan (contoh: "Deep Clean")
            $table->text('description')->nullable(); // Kolom untuk deskripsi (opsional, jadi kita beri ->nullable())
            $table->unsignedInteger('price'); // Kolom untuk harga. Kita gunakan integer untuk menghindari masalah koma. Simpan 25000, bukan 25.000.
            $table->timestamps(); // Otomatis membuat kolom created_at dan updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('services');
    }
};
