<?php

namespace App\Models\Api\Nurseries;

use App\Models\BaseModel;
use App\Models\Api\Generals\City;
use App\Models\Api\Generals\Country;
use App\Models\Api\Generals\Activity;
use App\Models\Api\Generals\Amenity;
use Spatie\Translatable\HasTranslations;
use App\Models\Api\Generals\Neighborhood;
use App\Models\Api\Generals\Service;
use App\Models\Api\Generals\Utility;
use App\Models\Api\Master\Child;
use App\Models\Api\Nurseries\JoinRequest\JoinRequest;
use App\Models\User;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Nursery extends BaseModel
{
    use HasTranslations;
    protected $hidden = ['pivot'];

    public $translatable = [];

    protected $fillable = [
        // 'name',
        'capacity',
        'acceptance_age',
        'country_id',
        'city_id',
        'neighborhood_id',
        'user_id',
        // 'street_number',
        'address_description',
        'latitude',
        'longitude',
        // 'disabilities_acceptance',
        'status',
        'is_active',
        'acceptance_age_from',
        'acceptance_age_to',
        'national_address',
        'building_type',
        'price',
        'nationality_id'
    ];
    protected $status = [
        0 => 'submitted',
        1 => 'reviewing',
        2 => 'inspecting',
        3 => 'inspected',
        4 => 'suspended',
        5 => 'approved',
    ];


    /**
     * Get the status.
     *
     * @param  string  $value
     * @return string
     */
    public function getStatusAttribute($value)
    {
        return $this->status[$value];
    }

    /**
     * Get the country that owns the Nursery
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function country(): BelongsTo
    {
        return $this->belongsTo(Country::class, 'country_id', 'id');
    }

    /**
     * Get the city that owns the Nursery
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function city(): BelongsTo
    {
        return $this->belongsTo(City::class, 'city_id', 'id');
    }

    /**
     * Get the neighborhood that owns the Nursery
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function neighborhood(): BelongsTo
    {
        return $this->belongsTo(Neighborhood::class, 'neighborhood_id', 'id');
    }


    /**
     * The activities that belong to the Nursery
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function activities(): BelongsToMany
    {
        return $this->belongsToMany(Activity::class, 'nursery_activities', 'nursery_id', 'activity_id')->withTimestamps();
    }


    /**
     * The children that belong to the Nursery
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function children(): BelongsToMany
    {
        return $this->belongsToMany(Child::class, 'nursery_children', 'nursery_id', 'child_id')->withTimestamps();
    }


    public function customerActivities()
    {
        return $this->activities()->whereNotNull('user_id')->get();
    }

    /**
     * Get all of the packages for the Nursery
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function packages(): HasMany
    {
        return $this->hasMany(PackageInfo::class, 'nursery_id', 'id');
    }


    public function packagesOfType($type)
    {
        return $this->packages()->where('type_id', $type)->get();
    }

    /**
     * Get the owner that owns the Nursery
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function owner(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }


    /**
     * Get the babySitter associated with the Nursery
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function babySitter(): HasOne
    {
        return $this->hasOne(BabysitterInfo::class, 'nursery_id', 'id');
    }


    /**
     * Get all of the joiningRequests for the Nursery
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function joiningRequests(): HasMany
    {
        return $this->hasMany(JoinRequest::class, 'nursery_id', 'id');
    }

    /**
     * Get all of the availabilities for the Nursery
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function availabilities(): HasMany
    {
        return $this->hasMany(NurseryAvailability::class, 'nursery_id', 'id');
    }

    /**
     * Get all of the amenities for the Nursery
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function amenities(): HasMany
    {
        return $this->hasMany(NurseryAmenity::class, 'nursery_id', 'id');
    }
    /**
     * Get all of the amenitiesInfo for the Nursery
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasManyThrough
     */
    public function amenitiesInfo(): HasManyThrough
    {
        return $this->hasManyThrough(Amenity::class, NurseryAmenity::class, 'nursery_id',  'id', 'id', 'amenity_id');
    }
    /**
     * Get all of the utilities for the Nursery
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function services(): belongsToMany
    {
        return $this->belongsToMany(Service::class, 'nursery_services', 'nursery_id', 'service_id')->withTimestamps();
    }
    /**
     * Get all of the utilities for the Nursery
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function utilities(): belongsToMany
    {
        return $this->belongsToMany(Utility::class, 'nursery_utilities', 'nursery_id', 'utility_id')->withTimestamps();
    }

    public static function boot()
    {
        parent::boot();

        static::deleting(function ($nursery) {
            $nursery->babySitter()->delete();
            foreach ($nursery->utilities()->get() as $utility) {
                $utility->delete();
            }
            foreach ($nursery->services()->get() as $service) {
                $service->delete();
            }
            // dd($nursery->amenities()->get());
            foreach ($nursery->amenities()->get() as $amenity) {
                $amenity->delete();
            }
        });
    }
}
