<?php

namespace App\Traits;

use App\Models\Order;
use App\Models\OrderItem;

trait OrderItemPaymentCalculationTrait
{
    public function paymentCalculation($order_id)
    {
        // OrderItem: Sum Sub Total
        $order_items = OrderItem::whereOrderId($order_id)->get();
        $grand_total = $order_items->sum('sub_total');

        // Find Previous discount
        $order = Order::find($order_id);
        $pre_discount = $order->total_discount;

        // Update Order Table
        $order->grand_total     = $grand_total;
        $order->total_discount  = $pre_discount;
        $order->total_amount    = $grand_total - $pre_discount;
        $order->save();
    }
}
