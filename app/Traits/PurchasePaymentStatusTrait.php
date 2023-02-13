<?php

namespace App\Traits;

trait PurchasePaymentStatusTrait
{
    // use it into 'purchase_payments'
    // use it into 'sales'
    public function paymentStatus($amount, $pay, $due): int
    {
        // 1=unPaid, 2=partiallyPaid, 3=paid
        if ($amount == $due && $pay == 0) {
            return 1;
        }
        if ($amount > $pay) {
            return 2;
        } else {
            return 3;
        }
    }

    // use it into 'purchase_payments'
    // use it into 'sale_payments'
    public function dueStatus($amount, $pay): int
    {
        // 1=unPaid, 2=paid
        return ($amount <= $pay) ? 2 : 1;
    }

}
