<?php

namespace App\Models\Api\Master;

use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Foundation\Auth\User as Authenticatable;


class Master extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes;

    protected $guard = 'master';
    protected $fillable = [
        'name',
        'email',
        'phone',
        'password',
        'preferred_language',
        'is_verified',
        'national_id',
        'is_active',
        'activation_code',
        'fcm_token',
        'address',
        'latitude',
        'longitude'
    ];

    protected $hidden = [
        'password',
        'pivot'
    ];


    /**
     * The children that belong to the Master
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function children(): BelongsToMany
    {
        return $this->belongsToMany(Child::class, 'master_children', 'master_id', 'child_id')->withTimestamps();
    }
}
