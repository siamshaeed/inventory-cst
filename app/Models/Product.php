<?php

namespace App\Models;

use App\Models\Blog\Category;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $table = 'products';
    protected $fillable = [
        'good_id', 'category_id', 'good_id',
        'model', 'details', 'stock', 'image', 'status'
    ];

    public function good()
    {
        return $this->belongsTo(Good::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }
}
