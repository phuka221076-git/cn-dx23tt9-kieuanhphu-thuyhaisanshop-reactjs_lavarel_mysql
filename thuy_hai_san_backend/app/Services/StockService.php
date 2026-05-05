<?php

namespace App\Services;

use App\Models\Product;
use Illuminate\Support\Facades\DB;

class StockService
{
    /**
     * Cộng lại số lượng vào kho khi hủy đơn
     */
    public function restoreStock($order)
    {
        DB::transaction(function () use ($order) {
            foreach ($order->items as $item) {
                // Sử dụng increment để tránh xung đột dữ liệu
                Product::where('id', $item->product_id)
                    ->increment('stock', $item->quantity);
            }
        });
    }

    /**
     * Trừ số lượng khi đặt hàng
     */
    public function reduceStock($items)
    {
        DB::transaction(function () use ($items) {
            foreach ($items as $item) {
                $product = Product::findOrFail($item['product_id']);
                
                if ($product->stock < $item['quantity']) {
                    throw new \Exception("Sản phẩm {$product->name} không đủ hàng!");
                }

                $product->decrement('stock', $item['quantity']);
            }
        });
    }
}