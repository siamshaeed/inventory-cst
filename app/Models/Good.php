<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Good extends Model
{
    use HasFactory;

    protected $table = 'goods';
    protected $fillable = [
        'name', 'status'
    ];

    public function products()
    {
        return $this->hasMany(Product::class, 'good_id', 'id');
    }
}
