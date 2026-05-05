<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class OrdersTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('orders')->delete();
        
        \DB::table('orders')->insert(array (
            0 => 
            array (
                'id' => 1,
                'user_id' => 4,
                'total_price' => '670000.00',
                'status' => 'pending',
                'shipping_adr' => '94B2 Trần Khắc Chân P. Đức Nhuận Tp. Hồ Chí Minh',
                'note' => '',
                'created_at' => '2026-04-27 16:11:51',
                'updated_at' => '2026-04-27 16:11:51',
            ),
            1 => 
            array (
                'id' => 2,
                'user_id' => 4,
                'total_price' => '1120000.00',
                'status' => 'pending',
                'shipping_adr' => '94B2 Trần Khắc Chân P. Đức Nhuận Tp. Hồ Chí Minh',
                'note' => '',
                'created_at' => '2026-04-27 16:23:47',
                'updated_at' => '2026-04-27 16:23:47',
            ),
            2 => 
            array (
                'id' => 3,
                'user_id' => 4,
                'total_price' => '1100000.00',
                'status' => 'pending',
                'shipping_adr' => '94B2 Trần Khắc Chân P. Đức Nhuận Tp. Hồ Chí Minh',
                'note' => '',
                'created_at' => '2026-04-27 16:49:34',
                'updated_at' => '2026-04-27 16:49:34',
            ),
            3 => 
            array (
                'id' => 4,
                'user_id' => 2,
                'total_price' => '1650000.00',
                'status' => 'pending',
                'shipping_adr' => 'Đại học Trà Vinh, số 126 Nguyễn Thiện Thành',
                'note' => '',
                'created_at' => '2026-04-27 16:57:02',
                'updated_at' => '2026-04-27 16:57:02',
            ),
            4 => 
            array (
                'id' => 5,
                'user_id' => 4,
                'total_price' => '1950000.00',
                'status' => 'pending',
                'shipping_adr' => 'dvdsv dfs df',
                'note' => '',
                'created_at' => '2026-04-27 17:54:30',
                'updated_at' => '2026-04-27 17:54:30',
            ),
            5 => 
            array (
                'id' => 6,
                'user_id' => 4,
                'total_price' => '670000.00',
                'status' => 'pending',
                'shipping_adr' => 'dsfdf',
                'note' => '',
                'created_at' => '2026-04-28 20:03:34',
                'updated_at' => '2026-04-28 20:03:34',
            ),
            6 => 
            array (
                'id' => 7,
                'user_id' => 4,
                'total_price' => '930000.00',
                'status' => 'pending',
                'shipping_adr' => 'sfd fs fd',
                'note' => '',
                'created_at' => '2026-04-28 20:06:16',
                'updated_at' => '2026-04-28 20:06:16',
            ),
            7 => 
            array (
                'id' => 8,
                'user_id' => 4,
                'total_price' => '1920000.00',
                'status' => 'pending',
                'shipping_adr' => '94B2 Trần Khắc Chân P. Đức Nhuận Tp. Hồ Chí Minh',
                'note' => '',
                'created_at' => '2026-04-28 20:56:57',
                'updated_at' => '2026-04-28 20:56:57',
            ),
            8 => 
            array (
                'id' => 10,
                'user_id' => 4,
                'total_price' => '2030000.00',
                'status' => 'pending',
                'shipping_adr' => '94B2 Trần Khắc Chân P. Đức Nhuận Tp. Hồ Chí Minh',
                'note' => '',
                'created_at' => '2026-04-28 21:27:09',
                'updated_at' => '2026-04-28 21:27:09',
            ),
            9 => 
            array (
                'id' => 11,
                'user_id' => 4,
                'total_price' => '660000.00',
                'status' => 'pending',
                'shipping_adr' => 'sdf fsdf dfdsf',
                'note' => '',
                'created_at' => '2026-04-28 21:29:21',
                'updated_at' => '2026-04-28 21:29:21',
            ),
            10 => 
            array (
                'id' => 12,
                'user_id' => 4,
                'total_price' => '3010000.00',
                'status' => 'pending',
                'shipping_adr' => 'ể 45435 43543 5',
                'note' => '',
                'created_at' => '2026-04-28 21:32:47',
                'updated_at' => '2026-04-28 21:32:47',
            ),
            11 => 
            array (
                'id' => 13,
                'user_id' => 4,
                'total_price' => '760000.00',
                'status' => 'pending',
                'shipping_adr' => '94B2 Trần Khắc Chân P. Đức Nhuận Tp. Hồ Chí Minh',
                'note' => '',
                'created_at' => '2026-04-28 21:43:25',
                'updated_at' => '2026-04-28 21:43:25',
            ),
            12 => 
            array (
                'id' => 20,
                'user_id' => 2,
                'total_price' => '8740000.00',
                'status' => 'pending',
                'shipping_adr' => 'Đại học Trà Vinh, số 126 Nguyễn Thiện Thành',
                'note' => '',
                'created_at' => '2026-04-28 22:06:15',
                'updated_at' => '2026-04-28 22:06:15',
            ),
            13 => 
            array (
                'id' => 21,
                'user_id' => 2,
                'total_price' => '830000.00',
                'status' => 'pending',
                'shipping_adr' => 'sfds fdsf dsf',
                'note' => '',
                'created_at' => '2026-04-28 23:04:10',
                'updated_at' => '2026-04-28 23:04:10',
            ),
            14 => 
            array (
                'id' => 22,
                'user_id' => 2,
                'total_price' => '1230000.00',
                'status' => 'pending',
                'shipping_adr' => 'sdfadsfds',
                'note' => '',
                'created_at' => '2026-04-29 12:43:31',
                'updated_at' => '2026-04-29 12:43:31',
            ),
            15 => 
            array (
                'id' => 23,
                'user_id' => 2,
                'total_price' => '950000.00',
                'status' => 'pending',
                'shipping_adr' => 'ear a êr ẻ',
                'note' => '',
                'created_at' => '2026-04-29 12:49:02',
                'updated_at' => '2026-04-29 12:49:02',
            ),
            16 => 
            array (
                'id' => 24,
                'user_id' => 4,
                'total_price' => '950000.00',
                'status' => 'pending',
                'shipping_adr' => '94B2 Trần Khắc Chân P. Đức Nhuận Tp. Hồ Chí Minh',
                'note' => '',
                'created_at' => '2026-04-29 13:06:28',
                'updated_at' => '2026-04-29 13:06:28',
            ),
            17 => 
            array (
                'id' => 25,
                'user_id' => 5,
                'total_price' => '1150000.00',
                'status' => 'pending',
                'shipping_adr' => '418 Trần Phú P. An Đông Tp. Hồ Chí Minh',
                'note' => '',
                'created_at' => '2026-04-29 13:08:47',
                'updated_at' => '2026-04-29 13:08:47',
            ),
            18 => 
            array (
                'id' => 26,
                'user_id' => 5,
                'total_price' => '500000.00',
                'status' => 'pending',
                'shipping_adr' => '418 Trần Phú P. An Đông Tp. Hồ Chí Minh',
                'note' => '',
                'created_at' => '2026-04-29 13:34:03',
                'updated_at' => '2026-04-29 13:34:03',
            ),
        ));
        
        
    }
}