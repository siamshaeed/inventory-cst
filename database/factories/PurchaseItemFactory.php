<?php

namespace Database\Factories;

use App\Models\PurchaseItem;
use Illuminate\Database\Eloquent\Factories\Factory;

class PurchaseItemFactory extends Factory
{
    protected $model = PurchaseItem::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'purchase_id'   => 1,
            'product_id'    => $this->faker->numberBetween(1,3),
            //'brand_id'      => $this->faker->numberBetween(1,3),
            //'supplier_id'   => $this->faker->numberBetween(1,3),
            //'warehouse_id'  => 1,
            'user_id'       => 1,
            'trade_type'    => 1,

            'quantity'      => 10,
            'unit_price'    => 20,
            'discount'      => 0,
            'sub_total'     => 200
        ];
    }
}
