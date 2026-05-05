<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            'Nhóm Tôm', 
            'Nhóm Cá', 
            'Cua & Ghẹ', 
            'Mực & Bạch Tuộc', 
            'Đồ khô đặc sản'
        ];
        
        foreach ($categories as $cat) {
            Category::create([
                'name' => $cat,
                'slug' => Str::slug($cat) // Kết quả: "nhom-tom", "nhom-ca"...
            ]);
        }
    }
}