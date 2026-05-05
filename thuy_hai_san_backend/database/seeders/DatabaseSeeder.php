<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;
use App\Models\Product;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(UsersTableSeeder::class);
        $this->call(CategoriesTableSeeder::class);
        $this->call(ProductsTableSeeder::class);
        $this->call(OrdersTableSeeder::class);
        $this->call(OrderItemsTableSeeder::class);
        // User::factory(10)->create();


/*         User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);
        // Tạo 10 đơn hàng, mỗi đơn hàng tự động tạo kèm 3 sản phẩm chi tiết
    Order::factory(10)->create()->each(function ($order) {
        OrderItem::factory(3)->create(['order_id' => $order->id]);
    });
 */
// 1. Tạo 3 User mặc định
  /*       
        // Admin
        User::updateOrCreate(
            ['id' => 1],
            [
                'name' => 'Administrator',
                'email' => 'admin@gmail.com',
                'password' => Hash::make('123456'),
                'role' => 'admin',
            ]
        );

        // User thường
        User::updateOrCreate(
            ['id' => 2],
            [
                'name' => 'Thành Viên Mẫu',
                'email' => 'user@gmail.com',
                'password' => Hash::make('123456'),
                'role' => 'user',
            ]
        );

        // Guest (Khách vãng lai)
        User::updateOrCreate(
            ['id' => 999999999],
            [
                'name' => 'Khách Vãng Lai',
                'email' => 'guest@thuyhaisan.com',
                'password' => Hash::make('no-password'),
                'role' => 'guest',
            ]
        );

        // 2. Sau khi có User, bạn có thể tạo Order mẫu
        // Ví dụ tạo đơn hàng cho User ID 2
        Order::factory(5)->create(['user_id' => 2])->each(function ($order) {
            OrderItem::factory(rand(1, 3))->create(['order_id' => $order->id]);
        });

        // Ví dụ tạo đơn hàng cho Guest (999999999)
        Order::factory(5)->create(['user_id' => 999999999])->each(function ($order) {
            OrderItem::factory(rand(1, 3))->create(['order_id' => $order->id]);
        });
    
        // Tạo 10 đơn hàng, mỗi đơn hàng tự động tạo kèm 3 sản phẩm chi tiết
        Order::factory(10)->create()->each(function ($order) {
            OrderItem::factory(3)->create(['order_id' => $order->id]);
        }); */
        /* $this->call([
            //UserSeeder::class,
            CategorySeeder::class,
            ProductSeeder::class,
            // Các seeder khác như CategorySeeder, ProductSeeder...
        ]); */
        
        
        
        
        
    }
}
