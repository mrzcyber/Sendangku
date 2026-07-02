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
        Schema::create('restaurant_orders', function (Blueprint $table) {
            $table->id();
            $table->string('order_code')->unique();
            $table->string('name');
            $table->foreignId('tables_id')->nullable()->constrained('tables')->nullOnDelete();
            $table->text('note')->nullable();
            $table->unsignedInteger('total_price');
            $table->enum('status', ['pending', 'success', 'failed'])->default('pending');
            $table->enum('payment', ['offline', 'online'])->default('online');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('restaurant_orders');
    }
};
