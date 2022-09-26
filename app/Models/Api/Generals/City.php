<?php

namespace App\Models\Api\Generals;

use App\Models\BaseModel;
use Spatie\Translatable\HasTranslations;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class City extends BaseModel
{
    use HasTranslations;
    public $translatable = ['name'];

    protected $fillable = [
        'name',
        'country_id'
    ];


    /**
     * Get the country that owns the City
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function country(): BelongsTo
    {
        return $this->belongsTo(Country::class, 'country_id', 'id');
    }

    /**
     * Get all of the nieghbourhood for the City
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function neighborhoods(): HasMany
    {
        return $this->hasMany(Neighborhood::class, 'city_id', 'id');
    }
}
