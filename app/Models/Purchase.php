<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class Purchase extends Model
{
    use HasFactory;

    protected $table = 'purchases';
    protected $fillable = [
        'user_id', 'supplier_id', 'date', 'invoice_number', 'purchase_status',
        'grand_amount', 'discount', 'total_amount', 'total_pay', 'total_due', 'payment_status'
    ];

    public function getDateAttribute($value)
    {
        return Carbon::parse($value)->format('d-m-Y');
    }


    public function isUnPaid(): bool
    {
        return $this->payment_status == 1;
    }

    public function isPartiallyPaid(): bool
    {
        return $this->payment_status == 2;
    }

    public function isPaid(): bool
    {
        return $this->payment_status == 3;
    }


    public function isOrdered(): bool
    {
        return $this->purchase_status == 1;
    }

    public function isPending(): bool
    {
        return $this->purchase_status == 2;
    }

    public function isReceived(): bool
    {
        return $this->purchase_status == 3;
    }


    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }

    public function items()
    {
        return $this->hasMany(PurchaseItem::class, 'purchase_id', 'id');
    }

}
