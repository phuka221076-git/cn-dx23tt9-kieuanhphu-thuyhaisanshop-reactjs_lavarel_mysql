<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('categories')->delete();
        
        \DB::table('categories')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'Nhóm Tôm',
                'description' => NULL,
                'slug' => 'nhom-tom',
                'is_active' => 1,
                'created_at' => '2026-04-25 03:29:41',
                'updated_at' => '2026-04-25 03:29:41',
            ),
            1 => 
            array (
                'id' => 2,
                'name' => 'Nhóm Cá',
                'description' => NULL,
                'slug' => 'nhom-ca',
                'is_active' => 1,
                'created_at' => '2026-04-25 03:29:41',
                'updated_at' => '2026-04-25 03:29:41',
            ),
            2 => 
            array (
                'id' => 3,
                'name' => 'Cua & Ghẹ',
                'description' => NULL,
                'slug' => 'cua-ghe',
                'is_active' => 1,
                'created_at' => '2026-04-25 03:29:41',
                'updated_at' => '2026-04-25 03:29:41',
            ),
            3 => 
            array (
                'id' => 4,
                'name' => 'Mực & Bạch Tuộc',
                'description' => NULL,
                'slug' => 'muc-bach-tuoc',
                'is_active' => 1,
                'created_at' => '2026-04-25 03:29:41',
                'updated_at' => '2026-04-25 03:29:41',
            ),
            4 => 
            array (
                'id' => 5,
                'name' => 'Đồ khô đặc sản',
                'description' => NULL,
                'slug' => 'do-kho-dac-san',
                'is_active' => 1,
                'created_at' => '2026-04-25 03:29:41',
                'updated_at' => '2026-04-25 03:29:41',
            ),
            5 => 
            array (
                'id' => 6,
                'name' => 'Mắm các loại',
                'description' => 'Lên men',
                'slug' => 'mam-cac-loai',
                'is_active' => 0,
                'created_at' => '2026-05-05 14:20:30',
                'updated_at' => '2026-05-12 15:05:53',
            ),
        ));
        
        
    }
}