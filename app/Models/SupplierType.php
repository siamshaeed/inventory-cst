<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SupplierType extends Model
{
    use HasFactory;

    protected $table = 'supplier_types';
    protected $fillable = [
        'name', 'title', 'address', 'slug', 'status'
    ];

    public function suppliers()
    {
        return $this->hasMany(Supplier::class, 'supplier_type_id');
    }

}
