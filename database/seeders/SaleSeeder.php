<?php

namespace Database\Seeders;

use App\Models\Sale;
use Illuminate\Database\Seeder;

class SaleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Sale::factory()->count(1)->create();
        Sale::create([
            'user_id'           => 1,
            'order_id'          => 2,
            'date'              => '2022-07-28 14:06:38',

            'grand_amount'      => 440,
            'total_discount'    => 20,
            'total_pre_due'     => 70,
            'total_amount'      => 490,

            'total_pay'         => 400,
            'total_due'         => 90,
            'payment_status'    => 1,
        ]);
    }
}
