<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'customer_name', 
        'customer_phone',
        'total_price',
        'status',
        'shipping_adr',
        'Delivery_hours',
        'note',
    ];

    // Quan hệ với chi tiết đơn hàng
    public function items() {
        return $this->hasMany(\App\Models\OrderItem::class, 'order_id');
    }

    public function user()
    {
        // Chỉ liên kết nếu user_id khác ID của Guest
        return $this->belongsTo(User::class, 'user_id')->where('id', '!=', 999999999);
    }
}