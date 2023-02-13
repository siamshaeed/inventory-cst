<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{
    use HasFactory;

    protected $table = 'stocks';
    protected $fillable = [
        'product_id', 'type', 'total_unit_price', 'total_quantity',
        'total_buying_price', 'total_selling_price'
    ];
}
