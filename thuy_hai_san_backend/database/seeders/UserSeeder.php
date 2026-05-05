<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Tạo tài khoản Admin mặc định
        User::create([
            'name' => 'Quản trị viên thủy hải sản',
            'email' => 'lienxokieu@gmail.com',
            'password' => Hash::make('12345678'), // Mật khẩu đăng nhập
            'role' => 'admin', // Nếu bạn có phân quyền
        ]);
    }
}