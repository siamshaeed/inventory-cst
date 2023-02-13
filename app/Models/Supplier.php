<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    use HasFactory;

    protected $table = 'suppliers';
    protected $fillable = [
        'supplier_type_id', 'name', 'title', 'phone_number', 'address', 'slug', 'status'
    ];

    public function market_type()
    {
        return $this->belongsTo(MarketType::class);
    }
}
