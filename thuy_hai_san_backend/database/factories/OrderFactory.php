<?php

namespace Database\Factories;

use App\Models\Order;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Order>
 */
class OrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => 9999999999, // ID của admin hoặc user mẫu
            'customer_name' => $this->faker->name(),
            'customer_phone' => $this->faker->phoneNumber(),
            'shipping_adr' => $this->faker->address(),
            'total_price' => 0, // Sẽ cập nhật sau khi tính toán item
            'status' => 'pending',
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
