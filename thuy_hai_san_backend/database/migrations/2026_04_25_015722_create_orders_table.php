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
    // 1. Bảng orders (Thông tin tổng quát)
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->decimal('total_price', 15, 2);
            $table->enum('status', ['pending', 'processing', 'shipping', 'completed', 'cancelled'])->default('pending');
            $table->text('shipping_adr');
            $table->text('note')->nullable();
            $table->timestamps(); // Sẽ tự tạo created_at (ngày đặt) và updated_at
        });

        /* // 2. Bảng order_items (Chi tiết sản phẩm)
        Schema::create('order_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_id')->constrained('orders')->onDelete('cascade');
            $table->foreignId('product_id')->constrained('products')->onDelete('cascade');
            $table->integer('quantity');
            $table->decimal('unit_price', 15, 2);
            $table->timestamps();
        }); */
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders_and_order_items_tables');
    }
};
