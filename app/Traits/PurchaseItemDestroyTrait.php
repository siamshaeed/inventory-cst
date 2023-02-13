<?php

namespace App\Traits;

use App\Models\Product;
use App\Models\Purchase;
use App\Models\PurchaseDue;
use App\Models\PurchaseItem;

trait PurchaseItemDestroyTrait
{
    public function purchaseItemDestroy($id, $tbl_foreign_id)
    {
        // Retrieve PurchaseItem
        $purchase_item  = PurchaseItem::find($id);
        $purchase_id    = $purchase_item->purchase_id;
        $quantity       = $purchase_item->quantity;
        $unit_price     = $purchase_item->unit_price;
        $discount       = $purchase_item->discount;
        $sub_total      = $purchase_item->sub_total;

        // Retrieve Purchase Data
        $purchase = Purchase::find($purchase_id);
        $purchase_grand_amount      = $purchase->grand_amount;
        $purchase_total_discount    = $purchase->total_discount;

        // Update Purchase Date
        $purchase->update([
            'grand_amount' => $purchase_grand_amount - $sub_total,
            'total_amount' => ($purchase_grand_amount - $sub_total) - $purchase_total_discount,
        ]);

        // Retrieve and Update Product Stock
        $product = Product::find($purchase_id);
        $product->update([
            'stock' => $product->stock - $quantity
        ]);
    }
}
