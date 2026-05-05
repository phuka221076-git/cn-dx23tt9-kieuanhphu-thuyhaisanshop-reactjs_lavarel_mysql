<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ProductsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('products')->delete();
        
        \DB::table('products')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'Tôm Càng Xanh Trà Vinh',
                'size' => 'size 5-7 con',
                'slug' => 'tom-cang-xanh-tra-vinh',
                'description' => 'Tôm càng xanh tự nhiên, thịt chắc ngọt, size 5-7 con/kg.


Giá trị thương phẩm
Chất lượng thịt: Thịt tôm càng xanh rất săn chắc, ngọt và có mùi thơm đặc trưng. Đặc biệt, phần gạch ở đầu tôm được coi là phần giá trị và ngon nhất.

Kích thước thương phẩm: Tôm thường đạt trọng lượng tốt nhất để thu hoạch khi đạt khoảng 100g – 200g/con, thậm chí có những con đực lớn có thể nặng tới 400g - 500g.',
                'price' => '380000.00',
                'unit' => 'kg',
                'stock' => 44,
                'image' => 'tom-cang-xanh.jpg',
                'category_id' => 1,
                'is_active' => 1,
                'type' => 'fresh',
                'created_at' => '2026-04-25 03:29:41',
                'updated_at' => '2026-04-25 03:29:41',
            ),
            1 => 
            array (
                'id' => 2,
                'name' => 'Tôm Sú Cà Mau L1',
            'size' => 'Đại(10 – 15 con)',
                'slug' => 'tom-su-ca-mau',
                'description' => 'Tôm sú sinh thái, vỏ mỏng thịt dày, giàu dinh dưỡng.',
                'price' => '450000.00',
                'unit' => 'kg',
                'stock' => 101,
                'image' => 'tom-su-ca-mau.jpg',
                'category_id' => 1,
                'is_active' => 1,
                'type' => 'fresh',
                'created_at' => '2026-04-25 03:29:41',
                'updated_at' => '2026-04-25 03:29:41',
            ),
            2 => 
            array (
                'id' => 3,
                'name' => 'Cá Hồi Na Uy Phi Lê',
                'size' => NULL,
                'slug' => 'ca-hoi-na-uy-phi-le',
                'description' => 'Cá hồi nhập khẩu trực tiếp, đạt chuẩn ăn sashimi.',
                'price' => '550000.00',
                'unit' => 'kg',
                'stock' => 0,
                'image' => 'ca-hoi-nauy-file.jpg',
                'category_id' => 2,
                'is_active' => 1,
                'type' => 'frozen',
                'created_at' => '2026-04-25 03:29:41',
                'updated_at' => '2026-04-25 03:29:41',
            ),
            3 => 
            array (
                'id' => 4,
                'name' => 'Cá Lóc Đồng Trà Vinh',
                'size' => NULL,
                'slug' => 'ca-loc-dong-tra-vinh',
                'description' => 'Cá lóc đồng làm sạch sẵn, phù hợp cho món canh chua.',
                'price' => '120000.00',
                'unit' => 'kg',
                'stock' => 106,
                'image' => 'ca-loc-dong-tra-vinh.jpg',
                'category_id' => 2,
                'is_active' => 1,
                'type' => 'fresh',
                'created_at' => '2026-04-25 03:29:41',
                'updated_at' => '2026-04-25 03:29:41',
            ),
            4 => 
            array (
                'id' => 5,
                'name' => 'Cá Bớp Nguyên Con',
                'size' => NULL,
                'slug' => 'ca-bop-nguyen-con',
                'description' => 'Cá bớp tươi sống chuyên dùng nấu lẩu, thịt béo và dai.',
                'price' => '280000.00',
                'unit' => 'kg',
                'stock' => 221,
                'image' => 'ca-bop-nguyen-con.jpg',
                'category_id' => 2,
                'is_active' => 1,
                'type' => 'fresh',
                'created_at' => '2026-04-25 03:29:41',
                'updated_at' => '2026-04-25 03:29:41',
            ),
            5 => 
            array (
                'id' => 6,
                'name' => 'Cua Gạch Cà Mau',
                'size' => NULL,
                'slug' => 'cua-gach-ca-mau',
                'description' => 'Cua gạch loại 1, bao ăn từng con, gạch đầy và béo.',
                'price' => '650000.00',
                'unit' => 'kg',
                'stock' => 43542,
                'image' => 'cua-gach-ca-mau.jpg',
                'category_id' => 3,
                'is_active' => 1,
                'type' => 'fresh',
                'created_at' => '2026-04-25 03:29:41',
                'updated_at' => '2026-04-25 03:29:41',
            ),
            6 => 
            array (
                'id' => 7,
                'name' => 'Ghẹ Xanh Phan Thiết',
                'size' => NULL,
                'slug' => 'ghe-xanh-phan-thiet',
                'description' => 'Ghẹ xanh đánh bắt tự nhiên, thịt thơm ngon.',
                'price' => '420000.00',
                'unit' => 'kg',
                'stock' => 0,
                'image' => 'ghe-xanh-phan-thiet.jpg',
                'category_id' => 3,
                'is_active' => 1,
                'type' => 'fresh',
                'created_at' => '2026-04-25 03:29:41',
                'updated_at' => '2026-04-25 03:29:41',
            ),
            7 => 
            array (
                'id' => 8,
                'name' => 'Mực Lá Miền Trung',
                'size' => NULL,
                'slug' => 'muc-la-mien-trung',
                'description' => 'Mực lá dày mình, giòn sần sật, phù hợp món xào hoặc nướng.',
                'price' => '350000.00',
                'unit' => 'kg',
                'stock' => 1111,
                'image' => 'muc-la-mien-trung.jpg',
                'category_id' => 4,
                'is_active' => 1,
                'type' => 'fresh',
                'created_at' => '2026-04-25 03:29:41',
                'updated_at' => '2026-04-25 03:29:41',
            ),
            8 => 
            array (
                'id' => 9,
                'name' => 'Bạch Tuộc Hai Da',
                'size' => NULL,
                'slug' => 'bach-tuoc-hai-da',
                'description' => 'Bạch tuộc tươi giòn, chuyên cho các quán nướng/lẩu.',
                'price' => '180000.00',
                'unit' => 'kg',
                'stock' => 3333,
                'image' => 'Bach-Tuoc-2-Da.jpg',
                'category_id' => 4,
                'is_active' => 1,
                'type' => 'frozen',
                'created_at' => '2026-04-25 03:29:41',
                'updated_at' => '2026-04-25 03:29:41',
            ),
            9 => 
            array (
                'id' => 10,
            'name' => 'Mực Khô Loại 1 (6-8 con/kg)',
                'size' => NULL,
                'slug' => 'muc-kho-loai-1-6-8-conkg',
                'description' => 'Mực khô câu tay, phơi nắng tự nhiên, thịt ngọt lịm.',
                'price' => '1150000.00',
                'unit' => 'kg',
                'stock' => 222,
                'image' => 'Muc-kho-loai-to.jpg',
                'category_id' => 5,
                'is_active' => 1,
                'type' => 'dried',
                'created_at' => '2026-04-25 03:29:41',
                'updated_at' => '2026-04-25 03:29:41',
            ),
            10 => 
            array (
                'id' => 11,
                'name' => 'Khô Cá Khoai Trà Vinh',
                'size' => NULL,
                'slug' => 'kho-ca-khoai-tra-vinh',
                'description' => 'Đặc sản khô cá khoai xứ biển Ba Động, nướng chấm mắm me.',
                'price' => '250000.00',
                'unit' => 'kg',
                'stock' => 444,
                'image' => 'kho-ca-khoai-size-co.jpg',
                'category_id' => 5,
                'is_active' => 1,
                'type' => 'dried',
                'created_at' => '2026-04-25 03:29:41',
                'updated_at' => '2026-04-25 03:29:41',
            ),
        ));
        
        
    }
}