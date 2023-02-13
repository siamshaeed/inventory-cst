<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Carbon;

class SalePayment extends Model
{
    use HasFactory;

    protected $table = 'sale_payments';
    protected $fillable = [
        'user_id', 'sale_id', 'date', 'amount', 'pay', 'due', 'status'
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

    public function sale(): BelongsTo
    {
        return $this->belongsTo(Sale::class, 'sale_id', 'id')->with(['order']);
    }
}
