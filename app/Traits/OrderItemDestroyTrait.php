<?php

namespace App\Traits;

use App\Models\Order;
use App\Models\OrderItem;

trait OrderItemDestroyTrait
{
    public function itemDestroy($id)
    {
        // Order info
        $order_item = OrderItem::find($id);

        // OrderItem List without remove id;
        $order_items = OrderItem::whereOrderId($order_item->order_id)->whereNotIn('id', [$id])->get();
        $sub_total_items = $order_items->sum('sub_total');

        // Order total_amount find
        $order = Order::find($order_item->order_id);
        $old_total_discount = $order->total_discount;
        $new_total_amount   = $sub_total_items - $old_total_discount;

        // Update Order Table
        $order->grand_total     = $sub_total_items;
        $order->total_amount    = $new_total_amount;
        $order->save();
    }
}
