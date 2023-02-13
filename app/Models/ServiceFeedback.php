<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Storage;

class ServiceFeedback extends Model
{
    use HasFactory;

    protected $table = "service_feedback";

    protected $fillable = [
        'user_id',
        'workshop_id',
        'service_request_id',
        'feedback',
        'rating'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function workshop(): BelongsTo
    {
        return $this->belongsTo(Workshop::class, 'workshop_id', 'id');
    }

    public function service_request(): BelongsTo
    {
        return $this->belongsTo(ServiceRequest::class, 'service_request_id', 'id');
    }


    /**
     * @return string
     */
    public function getUserPhoto(): string
    {
        if ($this->user && Storage::exists($this->user->photo)) {
            return asset('storage/'. $this->user->photo);
        }

        return asset('images/user.jpg');
    }

}
