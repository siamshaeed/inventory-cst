<?php

namespace App\Traits;

use App\Models\Sale;
use App\Models\SalePayment;

trait SalePaymentDestoryTrait
{
    public function salePaymentDestroy($id, $tbl_foreign_id)
    {
        // SalePayment
        $sale_payment   = SalePayment::find($id);
        $deleted_pay    = $sale_payment->pay;

        // Sale
        $sale           = Sale::find($tbl_foreign_id);
        $total_amount   = $sale->total_amount;
        $total_pay      = $sale->total_pay;

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

        // Update Sale
        $data = Sale::find($tbl_foreign_id);
        $data->total_pay        = $now_total_pay;
        $data->total_due        = $now_total_due;
        $data->payment_status   = $payment_status;
        $data->save();
    }
}
