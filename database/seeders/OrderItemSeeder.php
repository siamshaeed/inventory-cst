<?php

namespace Database\Seeders;

use App\Models\OrderItem;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class OrderItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        OrderItem::create([
            'user_id'       => 1,
            'order_id'      => 1,
            'product_id'    => 1,

            'date'          => '2022-07-20 14:06:38',
            'quantity'      => 6,
            'unit_price'    => 10,
            'discount'      => 10,
            'sub_total'     => 50,
        ]);
        OrderItem::create([
            'user_id'       => 1,
            'order_id'      => 1,
            'product_id'    => 2,

            'date'          => '2022-07-20 14:06:38',
            'quantity'      => 5,
            'unit_price'    => 20,
            'discount'      => 0,
            'sub_total'     => 100,
        ]);
        OrderItem::create([
            'user_id'       => 1,
            'order_id'      => 1,
            'product_id'    => 3,

            'date'          => '2022-07-20 14:06:38',
            'quantity'      => 3,
            'unit_price'    => 50,
            'discount'      => 20,
            'sub_total'     => 130,
        ]);


        OrderItem::create([
            'user_id'       => 1,
            'order_id'      => 2,
            'product_id'    => 3,

            'date'          => '2022-07-24 14:06:38',
            'quantity'      => 5,
            'unit_price'    => 40,
            'discount'      => 0,
            'sub_total'     => 200,
        ]);
        OrderItem::create([
            'user_id'       => 1,
            'order_id'      => 2,
            'product_id'    => 4,

            'date'          => '2022-07-24 14:06:38',
            'quantity'      => 7,
            'unit_price'    => 100,
            'discount'      => 50,
            'sub_total'     => 650,
        ]);
    }
}
