<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    use HasFactory;
    protected $table = 'addresses';
    protected $fillable = [
        'division_id', 'district_id', 'upazila_id', 'union_id',
        'name', 'bn_name', 'phone_1', 'phone_2', 'status'
    ];

}
