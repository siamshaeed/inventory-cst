<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Carbon;

class SaleItem extends Model
{
    use HasFactory;

    protected $table = 'sale_items';
    protected $fillable = [
        'user_id ', 'sale_id', 'order_item_id',
        'date', 'qty', 'unit_price', 'total_price', 'discount', 'sub_total'
    ];

    public function getDateAttribute($value)
    {
        return Carbon::parse($value)->format('d-m-Y');
    }


    public function sale(): BelongsTo
    {
        return $this->belongsTo(Sale::class, 'sale_id', 'id');
    }

    public function order_item(): BelongsTo
    {
        return $this->belongsTo(OrderItem::class, 'order_item_id', 'id')->with(['product']);
    }

    public function purchase_item(): BelongsTo
    {
        return $this->belongsTo(PurchaseItem::class, 'purchase_item_id', 'id');
    }

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class)->with(['good', 'brand', 'category']);
    }
}
