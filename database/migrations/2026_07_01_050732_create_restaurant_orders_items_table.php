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
        Schema::create('restaurant_orders_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('restaurant_orders_id')->constrained('restaurant_orders')->cascadeOnDelete();
            $table->foreignId('restaurant_menus_id')->nullable()->constrained('restaurant_menus')->nullOnDelete();
            $table->unsignedInteger('qty');
            $table->unsignedInteger('price');
            $table->unsignedInteger('subtotal');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('restaurant_orders_items');
    }
};
