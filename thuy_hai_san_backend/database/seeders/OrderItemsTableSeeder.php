<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class OrderItemsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('order_items')->delete();
        
        \DB::table('order_items')->insert(array (
            0 => 
            array (
                'id' => 2,
                'order_id' => 10,
                'product_id' => 2,
                'quantity' => 1,
                'unit_price' => '450000.00',
                'created_at' => '2026-04-28 21:27:09',
                'updated_at' => '2026-04-28 21:27:09',
            ),
            1 => 
            array (
                'id' => 3,
                'order_id' => 10,
                'product_id' => 10,
                'quantity' => 1,
                'unit_price' => '1150000.00',
                'created_at' => '2026-04-28 21:27:09',
                'updated_at' => '2026-04-28 21:27:09',
            ),
            2 => 
            array (
                'id' => 4,
                'order_id' => 10,
                'product_id' => 9,
                'quantity' => 1,
                'unit_price' => '180000.00',
                'created_at' => '2026-04-28 21:27:09',
                'updated_at' => '2026-04-28 21:27:09',
            ),
            3 => 
            array (
                'id' => 5,
                'order_id' => 10,
                'product_id' => 11,
                'quantity' => 1,
                'unit_price' => '250000.00',
                'created_at' => '2026-04-28 21:27:09',
                'updated_at' => '2026-04-28 21:27:09',
            ),
            4 => 
            array (
                'id' => 6,
                'order_id' => 11,
                'product_id' => 1,
                'quantity' => 1,
                'unit_price' => '380000.00',
                'created_at' => '2026-04-28 21:29:21',
                'updated_at' => '2026-04-28 21:29:21',
            ),
            5 => 
            array (
                'id' => 7,
                'order_id' => 11,
                'product_id' => 5,
                'quantity' => 1,
                'unit_price' => '280000.00',
                'created_at' => '2026-04-28 21:29:21',
                'updated_at' => '2026-04-28 21:29:21',
            ),
            6 => 
            array (
                'id' => 8,
                'order_id' => 12,
                'product_id' => 1,
                'quantity' => 2,
                'unit_price' => '380000.00',
                'created_at' => '2026-04-28 21:32:47',
                'updated_at' => '2026-04-28 21:32:47',
            ),
            7 => 
            array (
                'id' => 9,
                'order_id' => 12,
                'product_id' => 2,
                'quantity' => 5,
                'unit_price' => '450000.00',
                'created_at' => '2026-04-28 21:32:47',
                'updated_at' => '2026-04-28 21:32:47',
            ),
            8 => 
            array (
                'id' => 10,
                'order_id' => 13,
                'product_id' => 1,
                'quantity' => 2,
                'unit_price' => '380000.00',
                'created_at' => '2026-04-28 21:43:25',
                'updated_at' => '2026-04-28 21:43:25',
            ),
            9 => 
            array (
                'id' => 11,
                'order_id' => 20,
                'product_id' => 1,
                'quantity' => 23,
                'unit_price' => '380000.00',
                'created_at' => '2026-04-28 22:06:15',
                'updated_at' => '2026-04-28 22:06:15',
            ),
            10 => 
            array (
                'id' => 12,
                'order_id' => 21,
                'product_id' => 2,
                'quantity' => 1,
                'unit_price' => '450000.00',
                'created_at' => '2026-04-28 23:04:10',
                'updated_at' => '2026-04-28 23:04:10',
            ),
            11 => 
            array (
                'id' => 13,
                'order_id' => 21,
                'product_id' => 1,
                'quantity' => 1,
                'unit_price' => '380000.00',
                'created_at' => '2026-04-28 23:04:10',
                'updated_at' => '2026-04-28 23:04:10',
            ),
            12 => 
            array (
                'id' => 14,
                'order_id' => 22,
                'product_id' => 2,
                'quantity' => 1,
                'unit_price' => '450000.00',
                'created_at' => '2026-04-29 12:43:31',
                'updated_at' => '2026-04-29 12:43:31',
            ),
            13 => 
            array (
                'id' => 15,
                'order_id' => 22,
                'product_id' => 1,
                'quantity' => 1,
                'unit_price' => '380000.00',
                'created_at' => '2026-04-29 12:43:31',
                'updated_at' => '2026-04-29 12:43:31',
            ),
            14 => 
            array (
                'id' => 16,
                'order_id' => 22,
                'product_id' => 4,
                'quantity' => 1,
                'unit_price' => '120000.00',
                'created_at' => '2026-04-29 12:43:31',
                'updated_at' => '2026-04-29 12:43:31',
            ),
            15 => 
            array (
                'id' => 17,
                'order_id' => 22,
                'product_id' => 5,
                'quantity' => 1,
                'unit_price' => '280000.00',
                'created_at' => '2026-04-29 12:43:31',
                'updated_at' => '2026-04-29 12:43:31',
            ),
            16 => 
            array (
                'id' => 18,
                'order_id' => 23,
                'product_id' => 2,
                'quantity' => 1,
                'unit_price' => '450000.00',
                'created_at' => '2026-04-29 12:49:02',
                'updated_at' => '2026-04-29 12:49:02',
            ),
            17 => 
            array (
                'id' => 19,
                'order_id' => 23,
                'product_id' => 1,
                'quantity' => 1,
                'unit_price' => '380000.00',
                'created_at' => '2026-04-29 12:49:02',
                'updated_at' => '2026-04-29 12:49:02',
            ),
            18 => 
            array (
                'id' => 20,
                'order_id' => 23,
                'product_id' => 4,
                'quantity' => 1,
                'unit_price' => '120000.00',
                'created_at' => '2026-04-29 12:49:02',
                'updated_at' => '2026-04-29 12:49:02',
            ),
            19 => 
            array (
                'id' => 21,
                'order_id' => 24,
                'product_id' => 2,
                'quantity' => 1,
                'unit_price' => '450000.00',
                'created_at' => '2026-04-29 13:06:28',
                'updated_at' => '2026-04-29 13:06:28',
            ),
            20 => 
            array (
                'id' => 22,
                'order_id' => 24,
                'product_id' => 4,
                'quantity' => 1,
                'unit_price' => '120000.00',
                'created_at' => '2026-04-29 13:06:28',
                'updated_at' => '2026-04-29 13:06:28',
            ),
            21 => 
            array (
                'id' => 23,
                'order_id' => 24,
                'product_id' => 1,
                'quantity' => 1,
                'unit_price' => '380000.00',
                'created_at' => '2026-04-29 13:06:28',
                'updated_at' => '2026-04-29 13:06:28',
            ),
            22 => 
            array (
                'id' => 24,
                'order_id' => 25,
                'product_id' => 4,
                'quantity' => 1,
                'unit_price' => '120000.00',
                'created_at' => '2026-04-29 13:08:47',
                'updated_at' => '2026-04-29 13:08:47',
            ),
            23 => 
            array (
                'id' => 25,
                'order_id' => 25,
                'product_id' => 1,
                'quantity' => 1,
                'unit_price' => '380000.00',
                'created_at' => '2026-04-29 13:08:47',
                'updated_at' => '2026-04-29 13:08:47',
            ),
            24 => 
            array (
                'id' => 26,
                'order_id' => 25,
                'product_id' => 6,
                'quantity' => 1,
                'unit_price' => '650000.00',
                'created_at' => '2026-04-29 13:08:47',
                'updated_at' => '2026-04-29 13:08:47',
            ),
            25 => 
            array (
                'id' => 27,
                'order_id' => 26,
                'product_id' => 4,
                'quantity' => 1,
                'unit_price' => '120000.00',
                'created_at' => '2026-04-29 13:34:03',
                'updated_at' => '2026-04-29 13:34:03',
            ),
            26 => 
            array (
                'id' => 28,
                'order_id' => 26,
                'product_id' => 1,
                'quantity' => 1,
                'unit_price' => '380000.00',
                'created_at' => '2026-04-29 13:34:03',
                'updated_at' => '2026-04-29 13:34:03',
            ),
            27 => 
            array (
                'id' => 29,
                'order_id' => 27,
                'product_id' => 8,
                'quantity' => 1,
                'unit_price' => '350000.00',
                'created_at' => '2026-05-03 22:38:51',
                'updated_at' => '2026-05-03 22:38:51',
            ),
            28 => 
            array (
                'id' => 30,
                'order_id' => 27,
                'product_id' => 9,
                'quantity' => 1,
                'unit_price' => '180000.00',
                'created_at' => '2026-05-03 22:38:51',
                'updated_at' => '2026-05-03 22:38:51',
            ),
            29 => 
            array (
                'id' => 31,
                'order_id' => 28,
                'product_id' => 8,
                'quantity' => 3,
                'unit_price' => '350000.00',
                'created_at' => '2026-05-03 22:47:31',
                'updated_at' => '2026-05-03 22:47:31',
            ),
            30 => 
            array (
                'id' => 32,
                'order_id' => 29,
                'product_id' => 9,
                'quantity' => 1,
                'unit_price' => '180000.00',
                'created_at' => '2026-05-04 12:21:39',
                'updated_at' => '2026-05-04 12:21:39',
            ),
            31 => 
            array (
                'id' => 33,
                'order_id' => 29,
                'product_id' => 11,
                'quantity' => 1,
                'unit_price' => '250000.00',
                'created_at' => '2026-05-04 12:21:39',
                'updated_at' => '2026-05-04 12:21:39',
            ),
            32 => 
            array (
                'id' => 34,
                'order_id' => 29,
                'product_id' => 8,
                'quantity' => 1,
                'unit_price' => '350000.00',
                'created_at' => '2026-05-04 12:21:39',
                'updated_at' => '2026-05-04 12:21:39',
            ),
            33 => 
            array (
                'id' => 35,
                'order_id' => 30,
                'product_id' => 9,
                'quantity' => 1,
                'unit_price' => '180000.00',
                'created_at' => '2026-05-05 13:30:03',
                'updated_at' => '2026-05-05 13:30:03',
            ),
            34 => 
            array (
                'id' => 36,
                'order_id' => 30,
                'product_id' => 10,
                'quantity' => 1,
                'unit_price' => '1150000.00',
                'created_at' => '2026-05-05 13:30:03',
                'updated_at' => '2026-05-05 13:30:03',
            ),
            35 => 
            array (
                'id' => 37,
                'order_id' => 30,
                'product_id' => 8,
                'quantity' => 1,
                'unit_price' => '350000.00',
                'created_at' => '2026-05-05 13:30:03',
                'updated_at' => '2026-05-05 13:30:03',
            ),
            36 => 
            array (
                'id' => 38,
                'order_id' => 31,
                'product_id' => 5,
                'quantity' => 1,
                'unit_price' => '280000.00',
                'created_at' => '2026-05-05 13:30:28',
                'updated_at' => '2026-05-05 13:30:28',
            ),
            37 => 
            array (
                'id' => 39,
                'order_id' => 31,
                'product_id' => 6,
                'quantity' => 1,
                'unit_price' => '650000.00',
                'created_at' => '2026-05-05 13:30:28',
                'updated_at' => '2026-05-05 13:30:28',
            ),
            38 => 
            array (
                'id' => 40,
                'order_id' => 32,
                'product_id' => 8,
                'quantity' => 1,
                'unit_price' => '350000.00',
                'created_at' => '2026-05-05 13:54:27',
                'updated_at' => '2026-05-05 13:54:27',
            ),
            39 => 
            array (
                'id' => 41,
                'order_id' => 32,
                'product_id' => 2,
                'quantity' => 2,
                'unit_price' => '450000.00',
                'created_at' => '2026-05-05 13:54:27',
                'updated_at' => '2026-05-05 13:54:27',
            ),
            40 => 
            array (
                'id' => 42,
                'order_id' => 32,
                'product_id' => 6,
                'quantity' => 1,
                'unit_price' => '650000.00',
                'created_at' => '2026-05-05 13:54:27',
                'updated_at' => '2026-05-05 13:54:27',
            ),
            41 => 
            array (
                'id' => 43,
                'order_id' => 33,
                'product_id' => 11,
                'quantity' => 1,
                'unit_price' => '250000.00',
                'created_at' => '2026-05-06 22:33:30',
                'updated_at' => '2026-05-06 22:33:30',
            ),
            42 => 
            array (
                'id' => 44,
                'order_id' => 34,
                'product_id' => 10,
                'quantity' => 1,
                'unit_price' => '1150000.00',
                'created_at' => '2026-05-06 22:35:02',
                'updated_at' => '2026-05-06 22:35:02',
            ),
            43 => 
            array (
                'id' => 45,
                'order_id' => 35,
                'product_id' => 9,
                'quantity' => 1,
                'unit_price' => '180000.00',
                'created_at' => '2026-05-07 20:13:40',
                'updated_at' => '2026-05-07 20:13:40',
            ),
            44 => 
            array (
                'id' => 46,
                'order_id' => 35,
                'product_id' => 10,
                'quantity' => 1,
                'unit_price' => '1150000.00',
                'created_at' => '2026-05-07 20:13:40',
                'updated_at' => '2026-05-07 20:13:40',
            ),
            45 => 
            array (
                'id' => 47,
                'order_id' => 36,
                'product_id' => 12,
                'quantity' => 2,
                'unit_price' => '80000.00',
                'created_at' => '2026-05-07 20:15:12',
                'updated_at' => '2026-05-07 20:15:12',
            ),
            46 => 
            array (
                'id' => 48,
                'order_id' => 37,
                'product_id' => 9,
                'quantity' => 1,
                'unit_price' => '180000.00',
                'created_at' => '2026-05-07 20:19:11',
                'updated_at' => '2026-05-07 20:19:11',
            ),
            47 => 
            array (
                'id' => 49,
                'order_id' => 37,
                'product_id' => 10,
                'quantity' => 2,
                'unit_price' => '1150000.00',
                'created_at' => '2026-05-07 20:19:11',
                'updated_at' => '2026-05-07 20:19:11',
            ),
            48 => 
            array (
                'id' => 50,
                'order_id' => 38,
                'product_id' => 10,
                'quantity' => 1,
                'unit_price' => '1150000.00',
                'created_at' => '2026-05-07 20:27:54',
                'updated_at' => '2026-05-07 20:27:54',
            ),
            49 => 
            array (
                'id' => 51,
                'order_id' => 38,
                'product_id' => 11,
                'quantity' => 1,
                'unit_price' => '250000.00',
                'created_at' => '2026-05-07 20:27:54',
                'updated_at' => '2026-05-07 20:27:54',
            ),
            50 => 
            array (
                'id' => 52,
                'order_id' => 38,
                'product_id' => 9,
                'quantity' => 1,
                'unit_price' => '180000.00',
                'created_at' => '2026-05-07 20:27:54',
                'updated_at' => '2026-05-07 20:27:54',
            ),
            51 => 
            array (
                'id' => 53,
                'order_id' => 39,
                'product_id' => 9,
                'quantity' => 1,
                'unit_price' => '180000.00',
                'created_at' => '2026-05-07 20:29:43',
                'updated_at' => '2026-05-07 20:29:43',
            ),
            52 => 
            array (
                'id' => 54,
                'order_id' => 40,
                'product_id' => 12,
                'quantity' => 3,
                'unit_price' => '80000.00',
                'created_at' => '2026-05-07 20:36:43',
                'updated_at' => '2026-05-07 20:36:43',
            ),
            53 => 
            array (
                'id' => 55,
                'order_id' => 41,
                'product_id' => 11,
                'quantity' => 1,
                'unit_price' => '250000.00',
                'created_at' => '2026-05-07 20:41:37',
                'updated_at' => '2026-05-07 20:41:37',
            ),
            54 => 
            array (
                'id' => 56,
                'order_id' => 41,
                'product_id' => 12,
                'quantity' => 1,
                'unit_price' => '80000.00',
                'created_at' => '2026-05-07 20:41:37',
                'updated_at' => '2026-05-07 20:41:37',
            ),
            55 => 
            array (
                'id' => 57,
                'order_id' => 42,
                'product_id' => 10,
                'quantity' => 1,
                'unit_price' => '1150000.00',
                'created_at' => '2026-05-08 14:53:54',
                'updated_at' => '2026-05-08 14:53:54',
            ),
            56 => 
            array (
                'id' => 58,
                'order_id' => 42,
                'product_id' => 9,
                'quantity' => 1,
                'unit_price' => '180000.00',
                'created_at' => '2026-05-08 14:53:54',
                'updated_at' => '2026-05-08 14:53:54',
            ),
            57 => 
            array (
                'id' => 59,
                'order_id' => 43,
                'product_id' => 10,
                'quantity' => 1,
                'unit_price' => '1150000.00',
                'created_at' => '2026-05-08 15:15:49',
                'updated_at' => '2026-05-08 15:15:49',
            ),
            58 => 
            array (
                'id' => 60,
                'order_id' => 43,
                'product_id' => 11,
                'quantity' => 1,
                'unit_price' => '250000.00',
                'created_at' => '2026-05-08 15:15:49',
                'updated_at' => '2026-05-08 15:15:49',
            ),
            59 => 
            array (
                'id' => 61,
                'order_id' => 43,
                'product_id' => 12,
                'quantity' => 1,
                'unit_price' => '80000.00',
                'created_at' => '2026-05-08 15:15:49',
                'updated_at' => '2026-05-08 15:15:49',
            ),
            60 => 
            array (
                'id' => 62,
                'order_id' => 43,
                'product_id' => 9,
                'quantity' => 1,
                'unit_price' => '180000.00',
                'created_at' => '2026-05-08 15:15:49',
                'updated_at' => '2026-05-08 15:15:49',
            ),
            61 => 
            array (
                'id' => 63,
                'order_id' => 44,
                'product_id' => 10,
                'quantity' => 1,
                'unit_price' => '1150000.00',
                'created_at' => '2026-05-08 15:16:42',
                'updated_at' => '2026-05-08 15:16:42',
            ),
            62 => 
            array (
                'id' => 64,
                'order_id' => 44,
                'product_id' => 11,
                'quantity' => 1,
                'unit_price' => '250000.00',
                'created_at' => '2026-05-08 15:16:42',
                'updated_at' => '2026-05-08 15:16:42',
            ),
            63 => 
            array (
                'id' => 65,
                'order_id' => 44,
                'product_id' => 12,
                'quantity' => 1,
                'unit_price' => '80000.00',
                'created_at' => '2026-05-08 15:16:42',
                'updated_at' => '2026-05-08 15:16:42',
            ),
            64 => 
            array (
                'id' => 66,
                'order_id' => 45,
                'product_id' => 14,
                'quantity' => 1,
                'unit_price' => '60000.00',
                'created_at' => '2026-05-15 07:42:31',
                'updated_at' => '2026-05-15 07:42:31',
            ),
            65 => 
            array (
                'id' => 67,
                'order_id' => 46,
                'product_id' => 14,
                'quantity' => 1,
                'unit_price' => '60000.00',
                'created_at' => '2026-05-15 07:46:53',
                'updated_at' => '2026-05-15 07:46:53',
            ),
            66 => 
            array (
                'id' => 68,
                'order_id' => 47,
                'product_id' => 9,
                'quantity' => 1,
                'unit_price' => '180000.00',
                'created_at' => '2026-05-15 08:18:15',
                'updated_at' => '2026-05-15 08:18:15',
            ),
            67 => 
            array (
                'id' => 69,
                'order_id' => 47,
                'product_id' => 10,
                'quantity' => 1,
                'unit_price' => '1150000.00',
                'created_at' => '2026-05-15 08:18:15',
                'updated_at' => '2026-05-15 08:18:15',
            ),
            68 => 
            array (
                'id' => 70,
                'order_id' => 47,
                'product_id' => 11,
                'quantity' => 1,
                'unit_price' => '250000.00',
                'created_at' => '2026-05-15 08:18:15',
                'updated_at' => '2026-05-15 08:18:15',
            ),
            69 => 
            array (
                'id' => 71,
                'order_id' => 48,
                'product_id' => 10,
                'quantity' => 2,
                'unit_price' => '1150000.00',
                'created_at' => '2026-05-15 08:35:22',
                'updated_at' => '2026-05-15 08:35:22',
            ),
            70 => 
            array (
                'id' => 72,
                'order_id' => 48,
                'product_id' => 9,
                'quantity' => 1,
                'unit_price' => '180000.00',
                'created_at' => '2026-05-15 08:35:22',
                'updated_at' => '2026-05-15 08:35:22',
            ),
            71 => 
            array (
                'id' => 73,
                'order_id' => 48,
                'product_id' => 2,
                'quantity' => 5,
                'unit_price' => '450000.00',
                'created_at' => '2026-05-15 08:35:22',
                'updated_at' => '2026-05-15 08:35:22',
            ),
            72 => 
            array (
                'id' => 74,
                'order_id' => 49,
                'product_id' => 2,
                'quantity' => 5,
                'unit_price' => '450000.00',
                'created_at' => '2026-05-15 08:35:58',
                'updated_at' => '2026-05-15 08:35:58',
            ),
        ));
        
        
    }
}