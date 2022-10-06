<?php

namespace App\Models\Api\Generals;

use App\Models\BaseModel;
use Spatie\Translatable\HasTranslations;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Neighborhood extends BaseModel
{
    use HasTranslations;
    public $translatable = ['name'];

    protected $fillable = [
        'name',
        'city_id'
    ];


    /**
     * Get the city that owns the Neighborhood
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function city(): BelongsTo
    {
        return $this->belongsTo(City::class, 'city_id', 'id');
    }
}
