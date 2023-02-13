<?php

namespace App\Models;

use App\Models\Blog\Category;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class Expense extends Model
{
    use HasFactory;

    protected $table = 'expenses';
    protected $fillable = [
        'category_id', 'user_id', 'title', 'amount'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    //Date Formate
    public function getDateAttribute($value)
    {
        return Carbon::parse($value)->format('d-m-Y');
    }
}
