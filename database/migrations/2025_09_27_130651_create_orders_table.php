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
        Schema::create('orders', function (Blueprint $table) {
            $table->id(); 
            $table->string('order_id')->unique()->nullable(); 
            $table->foreignId('user_id')->constrained('users'); 
            $table->foreignId('service_id')->constrained('services'); 
            $table->string('delivery_method'); 
            $table->foreignId('location_id')->nullable()->constrained('locations'); 
            $table->text('customer_address')->nullable(); 
            $table->unsignedInteger('service_price');
            $table->unsignedInteger('delivery_fee');  
            $table->unsignedInteger('total_price');   
            $table->string('status')->default('pending'); 
            $table->string('payment_status')->default('pending'); 
            $table->string('snap_token')->nullable(); 
            $table->foreignId('worker_id')->nullable()->constrained('workers'); 
            $table->timestamps(); 
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
