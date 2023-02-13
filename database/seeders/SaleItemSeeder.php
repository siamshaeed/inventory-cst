<?php

namespace Database\Seeders;

use App\Models\SaleItem;
use Illuminate\Database\Seeder;

class SaleItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        SaleItem::create([
            'user_id'           => 1,
            'sale_id'           => 1,
            'order_item_id'     => 1,
            'product_id'        => 1,

            'date'          => '2022-07-20 14:06:38',
            'qty'           => 3,
            'unit_price'    => 50,
            'total_price'   => 150,
            'discount'      => 10,
            'sub_total'     => 140,
        ]);
        SaleItem::create([
            'user_id'       => 1,
            'sale_id'       => 1,
            'order_item_id' => 1,
            'product_id'    => 1,

            'date'          => '2022-07-22 14:06:38',
            'qty'           => 2,
            'unit_price'    => 100,
            'total_price'   => 200,
            'discount'      => 0,
            'sub_total'     => 200,
        ]);
        SaleItem::create([
            'user_id'       => 1,
            'sale_id'       => 1,
            'order_item_id' => 1,
            'product_id'    => 1,

            'date'          => '2022-07-24 14:06:38',
            'qty'           => 1,
            'unit_price'    => 300,
            'total_price'   => 300,
            'discount'      => 50,
            'sub_total'     => 250,
        ]);


        SaleItem::create([
            'user_id'       => 1,
            'sale_id'       => 2,
            'order_item_id' => 4,
            'product_id'    => 1,

            'date'          => '2022-08-14 14:06:38',
            'qty'           => 2,
            'unit_price'    => 100,
            'total_price'   => 200,
            'discount'      => 10,
            'sub_total'     => 190,
        ]);
        SaleItem::create([
            'user_id'       => 1,
            'sale_id'       => 2,
            'order_item_id' => 5,
            'product_id'    => 1,

            'date'          => '2022-08-14 14:06:38',
            'qty'           => 5,
            'unit_price'    => 50,
            'total_price'   => 250,
            'discount'      => 0,
            'sub_total'     => 250,
        ]);
    }
}
