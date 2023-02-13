<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiceList extends Model
{
    use HasFactory;

    protected $table = "service_lists";

    protected $fillable = [
        "name",
        "description",
        "logo",
        "repair_time",
        "discount",
        "status",
    ];

    public function category(){
        return $this->belongsTo(ServiceCategory::class, 'service_cat_id', 'id');
    }

}
