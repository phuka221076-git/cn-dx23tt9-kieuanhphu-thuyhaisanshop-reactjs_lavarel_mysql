<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $products = [
            // Nhóm Tôm
            [
                'name' => 'Tôm Càng Xanh Trà Vinh',
                'category_id' => 1,
                'price' => 380000,
                'unit' => 'kg',
                'stock' => 50,
                'type' => 'fresh',
                'image' => 'tom-cang-xanh.jpg',
                'description' => 'Tôm càng xanh tự nhiên, thịt chắc ngọt, size 5-7 con/kg.'
            ],
            [
                'name' => 'Tôm Sú Cà Mau',
                'category_id' => 1,
                'price' => 450000,
                'unit' => 'kg',
                'stock' => 30,
                'type' => 'fresh',
                'image' => 'tom-su-ca-mau.jpg',
                'description' => 'Tôm sú sinh thái, vỏ mỏng thịt dày, giàu dinh dưỡng.'
            ],
            // Nhóm Cá
            [
                'name' => 'Cá Hồi Na Uy Phi Lê',
                'category_id' => 2,
                'price' => 550000,
                'unit' => 'kg',
                'stock' => 15,
                'type' => 'frozen',
                'image' => 'ca-hoi-nauy-file.jpg',
                'description' => 'Cá hồi nhập khẩu trực tiếp, đạt chuẩn ăn sashimi.'
            ],
            [
                'name' => 'Cá Lóc Đồng Trà Vinh',
                'category_id' => 2,
                'price' => 120000,
                'unit' => 'kg',
                'stock' => 100,
                'type' => 'fresh',
                'image' => 'ca-loc-dong-tra-vinh.jpg',
                'description' => 'Cá lóc đồng làm sạch sẵn, phù hợp cho món canh chua.'
            ],
            [
                'name' => 'Cá Bớp Nguyên Con',
                'category_id' => 2,
                'price' => 280000,
                'unit' => 'kg',
                'stock' => 20,
                'type' => 'fresh',
                'image' => 'ca-bop-nguyen-con.jpg',
                'description' => 'Cá bớp tươi sống chuyên dùng nấu lẩu, thịt béo và dai.'
            ],
            // Nhóm Cua Ghẹ
            [
                'name' => 'Cua Gạch Cà Mau',
                'category_id' => 3,
                'price' => 650000,
                'unit' => 'kg',
                'stock' => 25,
                'type' => 'fresh',
                'image' => 'cua-gach-ca-mau.jpg',
                'description' => 'Cua gạch loại 1, bao ăn từng con, gạch đầy và béo.'
            ],
            [
                'name' => 'Ghẹ Xanh Phan Thiết',
                'category_id' => 3,
                'price' => 420000,
                'unit' => 'kg',
                'stock' => 40,
                'type' => 'fresh',
                'image' => 'ghe-xanh-phan-thiet.jpg',
                'description' => 'Ghẹ xanh đánh bắt tự nhiên, thịt thơm ngon.'
            ],
            // Nhóm Mực
            [
                'name' => 'Mực Lá Miền Trung',
                'category_id' => 4,
                'price' => 350000,
                'unit' => 'kg',
                'stock' => 60,
                'type' => 'fresh',
                'image' => 'muc-la-mien-trung.jpg',
                'description' => 'Mực lá dày mình, giòn sần sật, phù hợp món xào hoặc nướng.'
            ],
            [
                'name' => 'Bạch Tuộc Hai Da',
                'category_id' => 4,
                'price' => 180000,
                'unit' => 'kg',
                'stock' => 80,
                'type' => 'frozen',
                'image' => 'Bach-Tuoc-2-Da.jpg',
                'description' => 'Bạch tuộc tươi giòn, chuyên cho các quán nướng/lẩu.'
            ],
            // Nhóm Đồ khô
            [
                'name' => 'Mực Khô Loại 1 (6-8 con/kg)',
                'category_id' => 5,
                'price' => 1150000,
                'unit' => 'kg',
                'stock' => 20,
                'type' => 'dried',
                'image' => 'Muc-kho-loai-to.jpg',
                'description' => 'Mực khô câu tay, phơi nắng tự nhiên, thịt ngọt lịm.'
            ],
            [
                'name' => 'Khô Cá Khoai Trà Vinh',
                'category_id' => 5,
                'price' => 250000,
                'unit' => 'kg',
                'stock' => 100,
                'type' => 'dried',
                'image' => 'kho-ca-khoai-size-co.jpg',
                'description' => 'Đặc sản khô cá khoai xứ biển Ba Động, nướng chấm mắm me.'
            ],
        ];

        foreach ($products as $p) {
            Product::create([
                'name'        => $p['name'],
                'slug'        => Str::slug($p['name']), // Tự tạo slug cho sản phẩm
                'category_id' => $p['category_id'],
                'price'       => $p['price'],
                'image'       => $p['image'],
                'type'        => $p['type'],
                'description' => $p['description']
            ]);
        }

    }
}
