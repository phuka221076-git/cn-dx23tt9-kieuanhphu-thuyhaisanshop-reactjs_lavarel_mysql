<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

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
                'password' => '$2y$12$K1T3w9FxUhxllp3OM7QPDOVW6uUluxY7iwColthdX13x0977eq8l.',
                'phone' => '0123456789',
                'address' => 'Đại học Trà Vinh, số 126 Nguyễn Thiện Thành',
                'role' => 'admin',
                'is_active' => 1,
                'remember_token' => NULL,
                'created_at' => '2026-04-27 13:48:18',
                'updated_at' => '2026-05-05 14:48:03',
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
                'is_active' => 1,
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
                'is_active' => 1,
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
                'password' => '$2y$12$LbfRW4zy4kVTH8oCBMQrIOZhw7cxxFDI7bRvoGIWE7Tjw0Hux9xC.',
                'phone' => '0888128277',
                'address' => '418 Trần Phú P. An Đông Tp. Hồ Chí Minh',
                'role' => 'user',
                'is_active' => 1,
                'remember_token' => NULL,
                'created_at' => '2026-04-28 20:29:01',
                'updated_at' => '2026-05-07 20:31:57',
            ),
            4 => 
            array (
                'id' => 999999999,
                'name' => 'Khách vãng lai',
                'email' => 'guest@gmail.com',
                'email_verified_at' => NULL,
                'password' => '$2y$12$axnTkVPzPikea1BmgbxrTO28u6T5KLBGzEPAyQEOQ0nG0EOtkJfkS',
                'phone' => '0000000000',
                'address' => 'Hệ thống',
                'role' => 'guest',
                'is_active' => 1,
                'remember_token' => 'b2oOMcWKUA',
                'created_at' => '2026-05-03 22:36:50',
                'updated_at' => '2026-05-03 22:36:50',
            ),
            5 => 
            array (
                'id' => 1000000000,
                'name' => 'Toi',
                'email' => 'toi1@gmail.com',
                'email_verified_at' => NULL,
                'password' => '$2y$12$YGhenApDkNACHthF7TkeyuAyb35/7OYTKDflZlGywmEz.7geAjPOm',
                'phone' => '088888888',
                'address' => NULL,
                'role' => 'user',
                'is_active' => 0,
                'remember_token' => NULL,
                'created_at' => '2026-05-08 16:20:41',
                'updated_at' => '2026-05-12 15:07:54',
            ),
        ));
        
        
    }
}