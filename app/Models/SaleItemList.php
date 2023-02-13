<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Carbon;

class SaleItemList extends Model
{
    use HasFactory;

    protected $table = 'sale_item_lists';
    protected $fillable = [
        'id', 'user_id ', 'sale_id', 'sale_item_id', 'purchase_item_id', 'product_id',
        'date', 'qty',
    ];

    public function getDateAttribute($value)
    {
        return Carbon::parse($value)->format('d-m-Y');
    }

    public function sale(): BelongsTo
    {
        return $this->belongsTo(Sale::class, 'sale_id', 'id');
    }

    public function sale_item(): BelongsTo
    {
        return $this->belongsTo(SaleItem::class, 'sale_item_id', 'id')->with(['product']);
    }

    public function purchase_item(): BelongsTo
    {
        return $this->belongsTo(PurchaseItem::class, 'purchase_item_id', 'id');
    }

    /*public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class)->with(['good', 'brand', 'category']);
    }*/

}
