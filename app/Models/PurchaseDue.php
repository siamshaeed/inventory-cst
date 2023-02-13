<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class PurchaseDue extends Model
{
    use HasFactory;

    protected $table = 'purchase_dues';
    protected $fillable = [
        'user_id', 'purchase_id', 'date', 'amount', 'pay', 'due', 'payment_status'
    ];

    public function getDateAttribute($value)
    {
        return Carbon::parse($value)->format('d-m-Y');
    }

    public function isUnPaid(): bool
    {
        return $this->status == 1;
    }

    public function isPaid(): bool
    {
        return $this->status == 2;
    }

    public function purchase()
    {
        return $this->belongsTo(Purchase::class);
    }
}
