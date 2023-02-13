<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Storage;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'user_type',
        'photo',
        'is_verified',
        'status',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];



    /**
     * @return HasOne
     */
    public function workShop(): HasOne
    {
        return $this->hasOne(Workshop::class, 'user_id', 'id');
    }

    /**
     * @return HasMany
     */
    public function serviceRequests(): HasMany
    {
        return $this->hasMany(ServiceRequest::class, 'customer_id', 'id');
    }

    /**
     * @return HasMany
     */
    public function pendingRequests(): HasMany
    {
        return $this->hasMany(ServiceRequest::class, 'customer_id', 'id')
            ->where('status', 0);
    }



    /**
     * @return bool
     */
    public function isAdmin(): bool
    {
        return $this->user_type == 1;
    }

    /**
     * @return bool
     */
    public function isWorkshop(): bool
    {
        return $this->user_type == 2;
    }

    /**
     * @return bool
     */
    public function isUser(): bool
    {
        return $this->user_type == 3;
    }

    /**
     * @return bool
     */
    public function isCustomer(): bool
    {
        return $this->user_type == 3;
    }

    /**
     * @return bool
     */
    public function isVerified(): bool
    {
        return $this->is_verified == 1;
    }

    /**
     * @return bool
     */
    public function isUnVerified(): bool
    {
        return $this->is_verified == 0;
    }

    /**
     * @return string
     */
    public function getPhoto(): string
    {
        if (Storage::exists($this->photo)) {
            return asset('storage/'. $this->photo);
        }
        return asset('images/user2.jpg');
    }





}
