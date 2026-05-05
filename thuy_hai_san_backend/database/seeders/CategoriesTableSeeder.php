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
                'slug' => 'nhom-tom',
                'description' => NULL,
                'is_active' => 1,
                'created_at' => '2026-04-25 03:29:41',
                'updated_at' => '2026-04-25 03:29:41',
            ),
            1 => 
            array (
                'id' => 2,
                'name' => 'Nhóm Cá',
                'slug' => 'nhom-ca',
                'description' => NULL,
                'is_active' => 1,
                'created_at' => '2026-04-25 03:29:41',
                'updated_at' => '2026-04-25 03:29:41',
            ),
            2 => 
            array (
                'id' => 3,
                'name' => 'Cua & Ghẹ',
                'slug' => 'cua-ghe',
                'description' => NULL,
                'is_active' => 1,
                'created_at' => '2026-04-25 03:29:41',
                'updated_at' => '2026-04-25 03:29:41',
            ),
            3 => 
            array (
                'id' => 4,
                'name' => 'Mực & Bạch Tuộc',
                'slug' => 'muc-bach-tuoc',
                'description' => NULL,
                'is_active' => 1,
                'created_at' => '2026-04-25 03:29:41',
                'updated_at' => '2026-04-25 03:29:41',
            ),
            4 => 
            array (
                'id' => 5,
                'name' => 'Đồ khô đặc sản',
                'slug' => 'do-kho-dac-san',
                'description' => NULL,
                'is_active' => 1,
                'created_at' => '2026-04-25 03:29:41',
                'updated_at' => '2026-04-25 03:29:41',
            ),
        ));
        
        
    }
}