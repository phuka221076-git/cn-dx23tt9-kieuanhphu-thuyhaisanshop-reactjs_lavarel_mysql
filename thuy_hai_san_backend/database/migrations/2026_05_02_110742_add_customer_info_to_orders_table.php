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
        Schema::table('orders', function (Blueprint $table) {
            //
            Schema::table('orders', function (Blueprint $blueprint) {
                // Thêm các cột cho khách vãng lai (nullable vì khách có tài khoản sẽ không cần dùng)
                $blueprint->string('customer_name')->nullable()->after('user_id');
                $blueprint->string('customer_phone')->nullable()->after('customer_name');
                $blueprint->text('Delivery_hours')->nullable()->after('shipping_adr'); // Thêm cột ghi chú nếu chưa có
            });
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        
            //
        Schema::table('orders', function (Blueprint $blueprint) {
            $blueprint->dropColumn(['customer_name', 'customer_phone', 'notes']);
        });
        
    }
};
