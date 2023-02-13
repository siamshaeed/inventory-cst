<?php

namespace Database\Seeders;

use App\Models\PurchaseItem;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PurchaseItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //PurchaseItem::factory()->count(3)->create();

        PurchaseItem::create([
            'purchase_id'   => 1,
            'product_id'    => 1,
            'user_id'       => 1,
            'trade_type'    => 1,
            'quantity'      => 10,
            'unit_price'    => 20,
            'discount'      => 10,
            'sub_total'     => 190,
            'selling_price' => 25,
            'stock_available' => 10,
        ]);
        DB::table('products')->where('id', 1)->update(['stock' => 10]);

        PurchaseItem::create([
            'purchase_id'   => 1,
            'product_id'    => 2,
            'user_id'       => 1,
            'trade_type'    => 1,
            'quantity'      => 5,
            'unit_price'    => 20,
            'discount'      => 0,
            'sub_total'     => 100,
            'selling_price' => 30,
            'stock_available' => 5,
        ]);
        DB::table('products')->where('id', 2)->update(['stock' => 5]);

        PurchaseItem::create([
            'purchase_id'   => 1,
            'product_id'    => 3,
            'user_id'       => 1,
            'trade_type'    => 1,
            'quantity'      => 7,
            'unit_price'    => 30,
            'discount'      => 5,
            'sub_total'     => 205,
            'selling_price' => 35,
            'stock_available' => 7,
        ]);
        DB::table('products')->where('id', 3)->update(['stock' => 7]);
    }
}
