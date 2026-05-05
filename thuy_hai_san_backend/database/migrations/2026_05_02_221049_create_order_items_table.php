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
        Schema::create('order_items', function (Blueprint $table) {
            $table->id();
            // Liên kết với bảng orders (Phải trùng tên bảng orders trong DB của bạn)
            $table->foreignId('order_id')->constrained('orders')->onDelete('cascade');
            // Liên kết với bảng products
            $table->foreignId('product_id')->constrained('products');
            $table->integer('quantity');
            // 'unit_price' để khớp hoàn toàn với $fillable trong Model OrderItem của bạn
            $table->decimal('unit_price', 15, 2); 
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_items');
    }
};
