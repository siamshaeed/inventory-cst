<?php

namespace App\Models\Blog;

use App\Http\Controllers\ProductController;
use App\Models\Expense;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
      'name', 'type', 'status', 'slug'
    ];

    public function products()
    {
        return $this->hasMany(Product::class, 'category_id');
    }

    public function expenses()
    {
        return $this->hasMany(Expense::class, 'category_id');
    }

}
