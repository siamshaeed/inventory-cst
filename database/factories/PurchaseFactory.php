<?php

namespace Database\Factories;

use App\Models\Purchase;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class PurchaseFactory extends Factory
{
    protected $model = Purchase::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id'           => 1,
            'supplier_id'       => $this->faker->numberBetween(1,3),
            'date'              => '2022-07-10 14:06:38',
            'invoice_number'    => Str::random(4),
            'purchase_status'   => 2,

            'grand_amount'      => 495,
            'total_discount'    => 15,
            'total_amount'      => 480,

            'total_pay'         => 280,
            'total_due'         => 200,
            'payment_status'    => 2,
        ];
    }
}
