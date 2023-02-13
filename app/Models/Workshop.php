<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class Workshop extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = "workshops";

    protected $fillable = [
        'user_id',
        'name',
        'description',
        'logo',
        'signature',
        'latitude',
        'longitude',
        'license_number',
        'division_id',
        'district_id',
        'upazila_id',
        'union_id',
        'address',
        'zip_code',
        'contact_no',
        'opening_time',
        'closing_time',
    ];



    protected $casts = [
        'contact_no' => 'array',
    ];



    /**
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }


    /**
     * @return BelongsTo
     */
    public function divisions(): BelongsTo
    {
        return $this->belongsTo(Division::class, 'division_id', 'id');
    }

    /**
     * @return BelongsTo
     */
    public function districts(): BelongsTo
    {
        return $this->belongsTo(District::class, 'district_id', 'id');
    }

    /**
     * @return BelongsTo
     */
    public function upazilas(): BelongsTo
    {
        return $this->belongsTo(Upazila::class, 'upazila_id', 'id');
    }

    /**
     * @return BelongsTo
     */
    public function unions(): BelongsTo
    {
        return $this->belongsTo(Union::class, 'union_id', 'id');
    }


    public function getContactNo()
    {
    }


    /**
     * @return string
     */
    public function getLogo(): string
    {
        if (Storage::exists($this->logo)) {
            return asset('storage/' . $this->logo);
        }
        return asset('images/workshop/logo/blank_workshop.png');
    }



    /**
     * @return string
     */
    public function getSignature(): string
    {
        if (Storage::exists($this->signature)) {
            return asset('storage/' . $this->signature);
        }

        return asset('images/examples/icons8-no-camera-48.png');
    }


    /**
     * @return HasMany
     */
    public function serviceFeedback(): HasMany
    {
        return $this->hasMany(ServiceFeedback::class, 'workshop_id', 'id')
            ->orderByDesc('id');
    }


    /**
     * @return mixed|float
     */
    public function getRating()
    {
        return $this->serviceFeedback()->avg('rating');
    }






//    add rest



}
