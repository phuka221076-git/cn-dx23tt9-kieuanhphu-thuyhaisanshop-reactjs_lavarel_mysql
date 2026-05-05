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
        ));
        
        
    }
}