<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MarketType extends Model
{
    use HasFactory;
    protected $fillable = [
        'name', 'title', 'slug', 'status'
    ];

    public function suppliers()
    {
        return $this->hasMany(Supplier::class, 'market_type_id');
    }
}
