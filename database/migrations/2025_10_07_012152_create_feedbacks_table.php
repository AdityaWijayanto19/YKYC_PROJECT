<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    // database/migrations/xxxx_xx_xx_xxxxxx_create_feedbacks_table.php

    public function up()
    {
        Schema::create('feedbacks', function (Blueprint $table) {
            $table->id();

            // Relasi ke tabel lain
            $table->foreignId('order_id')->constrained()->onDelete('cascade')->unique(); // 1 order = 1 feedback
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade'); // Siapa yang memberi feedback
            $table->foreignId('worker_id')->constrained('workers')->onDelete('cascade'); // Siapa yang di-review

            // Data feedback
            $table->tinyInteger('rating')->unsigned(); // Angka 1-5
            $table->text('comment')->nullable(); // Komentar opsional

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('feedbacks');
    }
};
