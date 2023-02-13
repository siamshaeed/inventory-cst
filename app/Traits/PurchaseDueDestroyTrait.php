<?php

namespace App\Traits;

use App\Models\Purchase;
use App\Models\PurchaseDue;

trait PurchaseDueDestroyTrait
{
    public function dueDestroy($id, $tbl_foreign_id)
    {
        // PurchaseDue
        $purchase_due = PurchaseDue::find($id);
        $deleted_pay = $purchase_due->pay;

        // Purchase
        $purchase       = Purchase::find($tbl_foreign_id);
        $total_amount   = $purchase->total_amount;
        $total_pay      = $purchase->total_pay;

        // Calculation
        $now_total_pay  = $total_pay - $deleted_pay;
        $now_total_due  = $total_amount - $now_total_pay;

        // Purchase: Payment Status
        if(($now_total_due == 0) || ($now_total_due <= 0)){
            $payment_status = 3;
        } elseif ($now_total_due > 0) {
            $payment_status = 2;
        }
        if ($now_total_pay == 0) {
            $payment_status = 1;
        }

        // Update Purchase
        $data = Purchase::find($tbl_foreign_id);
        $data->total_pay        = $now_total_pay;
        $data->total_due        = $now_total_due;
        $data->payment_status   = $payment_status;
        $data->save();
    }
}
