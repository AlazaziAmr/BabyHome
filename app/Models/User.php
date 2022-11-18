<?php

namespace App\Models;

use App\Models\Api\Generals\Activity;
use App\Models\Api\Nurseries\BabysitterInfo;
use App\Models\Api\Nurseries\Nursery;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes;

    protected $fillable = [
        'name',
        'email',
        'phone',
        'password',
        'preferred_language',
        'is_verified',
        // 'national_id',
        'is_active',
        'has_nursery',
        'fcm_token',
        'activation_code'
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

    public static function boot()
    {
        parent::boot();

        static::deleting(function ($user) {
            $user->info()->delete();
            foreach ($user->activities()->get() as $activity) {
                $activity->delete();
            }
            foreach ($user->nurseries()->get() as $nursery) {
                $nursery->delete();
            }
        });

        static::restoring(function ($user) {
            $user->info()->withTrashed()->where('deleted_at','>=',$user->deleted_at)->restore();
            foreach ($user->activities()->where('deleted_at','>=',$user->deleted_at)->get() as $activity){
                $activity->restore();
            }
            foreach ($user->nurseries()->where('deleted_at','>=',$user->deleted_at)->get() as $nursery) {
                $nursery->restore();
            }
        });
    }

    /**
     * Get all of the activities for the User
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function activities(): HasMany
    {
        return $this->hasMany(Activity::class, 'user_id', 'id');
    }

    /**
     * Get all of the nurseries for the User
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function nurseries(): HasMany
    {
        return $this->hasMany(Nursery::class, 'user_id', 'id');
    }

    /**
     * Get the info associated with the User
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function info(): HasOne
    {
        return $this->hasOne(BabysitterInfo::class, 'user_id', 'id');
    }
}
