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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name')->comment('Tên loại thủy hải sản');
            $table->string('slug')->unique()->comment('Đường dẫn thân thiện cho SEO');
            $table->text('description')->nullable()->comment('Mô tả chi tiết sản phẩm');
            
            // Giá sản phẩm: sử dụng decimal để chính xác về tiền tệ
            $table->decimal('price', 15, 2)->default(0); 
            
            // Đặc thù ngành thủy sản: đơn vị tính (kg, con, khay, túi...)
            $table->string('unit')->default('kg'); 
            
            // Quản lý tồn kho
            $table->integer('stock')->default(0)->comment('Số lượng còn lại trong kho');
            
            // Hình ảnh sản phẩm
            $table->string('image')->nullable();
            
            // Danh mục: Liên kết với bảng categories (nếu bạn đã tạo bảng categories)
            // Nếu chưa tạo bảng categories, bạn có thể tạm thời comment dòng dưới lại
            $table->foreignId('category_id')->constrained()->onDelete('cascade');

            
            // Trạng thái: 1 - Đang bán, 0 - Tạm ẩn
            $table->boolean('is_active')->default(true);
            
            // Gắn nhãn đặc thù: Tươi sống, Đông lạnh, Khô, Lên men
            $table->enum('type', ['fresh', 'frozen', 'dried', 'fermentation'])->default('fresh');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
