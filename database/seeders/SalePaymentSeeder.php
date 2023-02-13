<?php

namespace Database\Seeders;

use App\Models\SalePayment;
use Illuminate\Database\Seeder;

class SalePaymentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        SalePayment::create([
            'user_id'   => 1,
            'sale_id'   => 1,

            'date'      => '2022-07-20 14:06:38',
            'Amount'    => 600,
            'pay'       => 400,
            'due'       => 200,
            'status'    => 1,
        ]);
        SalePayment::create([
            'user_id'   => 1,
            'sale_id'   => 1,

            'date'      => '2022-07-25 14:06:38',
            'Amount'    => 200,
            'pay'       => 120,
            'due'       => 80,
            'status'    => 1,
        ]);

        SalePayment::create([
            'user_id'   => 1,
            'sale_id'   => 2,

            'date'      => '2022-08-14 14:06:38',
            'Amount'    => 490,
            'pay'       => 300,
            'due'       => 190,
            'status'    => 1,
        ]);
        SalePayment::create([
            'user_id'   => 1,
            'sale_id'   => 2,

            'date'      => '2022-08-16 14:06:38',
            'Amount'    => 190,
            'pay'       => 100,
            'due'       => 90,
            'status'    => 1,
        ]);
    }
}
