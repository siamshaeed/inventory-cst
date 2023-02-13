<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Carbon;

class OrderItem extends Model
{
    use HasFactory;
    protected $table = 'order_items';
    protected $fillable = [
        'user_id', 'order_id', 'product_id', 'quantity', 'unit_price', 'discount', 'sub_total', 'item_status'
    ];

    public function getDateAttribute($value): string
    {
        return Carbon::parse($value)->format('d-m-Y');
    }

    public function isRequest(): bool
    {
        return $this->item_status == 1;
    }
    public function isPending(): bool
    {
        return $this->item_status == 2;
    }
    public function isCompleted(): bool
    {
        return $this->item_status == 3;
    }


    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class)->with(['good', 'brand', 'category']);
    }
}
