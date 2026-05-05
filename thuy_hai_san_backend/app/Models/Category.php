<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    // Thêm dòng này để cho phép lưu dữ liệu nhanh từ Seeder
    protected $fillable = ['name', 'description', 'slug'];

    // Thiết lập mối quan hệ với Sản phẩm (1 danh mục có nhiều sản phẩm)
    public function products()
    {
        return $this->hasMany(Product::class);
    }
}