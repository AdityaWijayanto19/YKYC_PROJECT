<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->enum('status', [
                'pending', 
                'waiting', 
                'on the way', 
                'diproses', 
                'In Progress', 
                'ready for pick up', 
                'Siap Ambil', 
                'completed', 
                'cancelled', 
                'dibatalkan'
            ])->default('pending')->change();
        });
    }
};