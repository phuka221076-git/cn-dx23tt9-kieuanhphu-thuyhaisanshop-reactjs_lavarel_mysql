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
        Schema::table('products', function (Blueprint $table) {
            // Thêm cột size sau cột name, cho phép để trống (nullable)
            $table->string('size')->nullable()->after('name'); 
        });
    }

    public function down()
    {
        Schema::table('products', function (Blueprint $table) {
            // Xóa cột size nếu rollback
            $table->dropColumn('size');
        });
    }
};
