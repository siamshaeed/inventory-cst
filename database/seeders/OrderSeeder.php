<?php

namespace Database\Seeders;

use App\Models\Order;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Order::factory()->count(1)->create();
        Order::Create([
            'user_id'               => 1,
            'supplier_id'           => 2,
            'date'                  => '2022-07-24 14:06:38',
            'order_number'          => '5052',
            'grand_total'           => 850,
            'total_discount'        => 50,
            'total_amount'          => 800,
        ]);
    }
}
