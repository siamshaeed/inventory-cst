<?php

namespace Database\Seeders;

use App\Models\Stock;
use Illuminate\Database\Seeder;

class StockSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Type: 1=Purchase, 2=Sell
        for ($i=1; $i<=20; $i++){
            //Type: 1=Purchase
            Stock::create([
                'product_id'    => $i,
                'type'          => 1,
            ]);

            //Type: 2=Sell
            Stock::create([
                'product_id'    => $i,
                'type'          => 2,
            ]);
        }
    }
}
