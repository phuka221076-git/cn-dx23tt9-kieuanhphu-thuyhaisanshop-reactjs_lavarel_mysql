<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('users')->delete();
        
        \DB::table('users')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'Phú Trà Vinh',
                'email' => 'phu@gmail.com',
                'email_verified_at' => NULL,
                'password' => '$2y$12$iaOOcTtGhftVLzScLX98L.GEDzM0RQCSEyKWsGwME19lbY4k29LPq',
                'phone' => '0123456789',
                'address' => 'Đại học Trà Vinh, số 126 Nguyễn Thiện Thành',
                'role' => 'admin',
                'remember_token' => NULL,
                'created_at' => '2026-04-27 13:48:18',
                'updated_at' => '2026-04-27 13:48:18',
            ),
            1 => 
            array (
                'id' => 2,
                'name' => 'Quản trị viên',
                'email' => 'admin@gmail.com',
                'email_verified_at' => NULL,
                'password' => '$2y$12$VHwjSBehOmgkZNsk0TkM1OFdeXAUIK9yyjSuD.oCeWtwEWIlb3CxO',
                'phone' => '0123456789',
                'address' => 'Đại học Trà Vinh, số 126 Nguyễn Thiện Thành',
                'role' => 'admin',
                'remember_token' => NULL,
                'created_at' => '2026-04-27 14:11:19',
                'updated_at' => '2026-04-27 14:11:19',
            ),
            2 => 
            array (
                'id' => 4,
                'name' => 'Kim Hằng',
                'email' => 'laikimhang80@gmail.com',
                'email_verified_at' => NULL,
                'password' => '$2y$12$A3P/oYpINzCZfIZApBwBeuMj3x02NQPGlawR.Z6YFahBcEbPuChPK',
                'phone' => '0888517980',
                'address' => '94B2 Trần Khắc Chân P. Đức Nhuận Tp. Hồ Chí Minh',
                'role' => 'user',
                'remember_token' => NULL,
                'created_at' => '2026-04-27 14:56:10',
                'updated_at' => '2026-04-27 14:56:10',
            ),
            3 => 
            array (
                'id' => 5,
                'name' => 'toi',
                'email' => 'lienxokieu@gmail.com',
                'email_verified_at' => NULL,
                'password' => '$2y$12$bsO9.RTA/uDV4hDHTw3wlOWdv5GxRKuiwhUU9XAYWgM8SX/ZUAtTK',
                'phone' => '0888128277',
                'address' => '418 Trần Phú P. An Đông Tp. Hồ Chí Minh',
                'role' => 'user',
                'remember_token' => NULL,
                'created_at' => '2026-04-28 20:29:01',
                'updated_at' => '2026-04-28 20:29:01',
            ),
            4 => 
            array (
                'id' => 999999999,
                'name' => 'Khách vãng lai',
                'email' => 'guest@gmail.com',
                'email_verified_at' => NULL,
                'password' => Hash::make('không_có_mật_khẩu'),
                'phone' => '0000000000', // Thêm cột này
                'address' => 'Hệ thống',   // Thêm cột này
                'role' => 'guest',
                'remember_token' => Str::random(10),
                'created_at' => now(),    // Thêm cột này
                'updated_at' => now(),    // Thêm cột này
            ),
        ));
        
        
    }
}