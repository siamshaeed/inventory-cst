<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Carbon;

class Sale extends Model
{
    use HasFactory;

    protected $table = 'sales';
    protected $fillable = [
        'user_id', 'order_id',
        'date', 'grand_amount', 'total_discount', 'pre_due', 'total_amount', 'total_pay', 'total_due', 'payment_status'
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

    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class, 'order_id', 'id')->with('supplier');
    }
    public function sale_items(): HasMany
    {
        return $this->hasMany(SaleItem::class, 'order_item_id', 'id');
    }
}
