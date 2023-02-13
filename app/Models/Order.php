<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Carbon;

class Order extends Model
{
    use HasFactory;
    protected $table = 'orders';
    protected $fillable = [
        'user_id', 'supplier_id', 'date', 'order_number', 'order_total_amount', 'image', 'order_status'
    ];

    public function getDateAttribute($value)
    {
        return Carbon::parse($value)->format('d-m-Y');
    }

    public function isRequest(): bool
    {
        return $this->order_status == 1;
    }
    public function isPending(): bool
    {
        return $this->order_status == 2;
    }
    public function isCompleted(): bool
    {
        return $this->order_status == 3;
    }


    public function supplier(): BelongsTo
    {
        return $this->belongsTo(Supplier::class, 'supplier_id', 'id')->with(['market_type']);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

}
