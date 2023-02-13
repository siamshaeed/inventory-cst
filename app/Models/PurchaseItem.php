<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PurchaseItem extends Model
{
    use HasFactory;

    protected $table = 'purchase_items';
    protected $fillable = [
        'purchase_id', 'product_id', 'user_id', 'trade_type',
        'quantity', 'unit_price', 'discount', 'sub_total', 'selling_price'
    ];
    protected $guarded = [];

    public function isStockAvailable(): bool
    {
        return $this->stock_status == 1;
    }
    public function isStockOut(): bool
    {
        return $this->stock_status == 0;
    }


    public function purchase(): BelongsTo
    {
        return $this->belongsTo(Purchase::class);
    }

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class)->with(['good', 'brand']);
    }
}
