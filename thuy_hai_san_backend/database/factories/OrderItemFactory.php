<?php

namespace Database\Factories;

use App\Models\OrderItem;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<OrderItem>
 */
class OrderItemFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        // Lấy một sản phẩm ngẫu nhiên trong bảng products
        $product = \App\Models\Product::inRandomOrder()->first();

        return [
            'product_id' => $product ? $product->id : 1, // Nếu chưa có sản phẩm nào thì tạm để 1
            'quantity' => rand(1, 5), // Số lượng ngẫu nhiên từ 1 đến 5
            'unit_price' => $product ? $product->price : 50000, // Lấy giá từ sản phẩm hoặc để mặc định
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
