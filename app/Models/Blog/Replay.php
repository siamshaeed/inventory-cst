<?php

namespace App\Models\Blog;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Replay extends Model
{
    use HasFactory;

    protected $fillable = [
      'comment_id', 'post_id', 'user_id', 'text'
    ];
}
