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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('order_code')->unique();
            $table->uuid('qr_token')->unique();
            $table->string('buyer_name');
            $table->string('buyer_phone');
            $table->string('buyer_email');
            $table->unsignedInteger('total_price');
            $table->enum('status', ['active', 'used'])->default('active');
            $table->enum('purchase', ['online', 'offline']);
            $table->timestamp('scanned_at')->nullable();
            $table->foreignId('scanned_by')->nullable()->constrained('users')->nullOnDelete();
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
