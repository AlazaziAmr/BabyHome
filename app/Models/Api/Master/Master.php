<?php

namespace App\Models\Api\Master;

use App\Models\Api\Generals\Nationality;
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
        'uid',
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
        'longitude',
        'nationality_id'
    ];

    protected $hidden = [
        'password',
        'pivot'
    ];

    public function nationality(){
        return $this->belongsTo(Nationality::class);
    }
    public function children(): BelongsToMany
    {
        return $this->belongsToMany(Child::class, 'master_children', 'master_id', 'child_id')->withTimestamps();
    }
}
