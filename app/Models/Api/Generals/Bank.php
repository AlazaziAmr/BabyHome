<?php

namespace App\Models\Api\Generals;

use App\Models\BaseModel;
use App\Models\Api\Generals\Country;
use Spatie\Translatable\HasTranslations;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Bank extends BaseModel
{
    use HasTranslations;

    public $translatable = ['name'];
    protected $fillable = [
        'name',
        'logo',
        'status',
        'country_id'
    ];


    /**
     * Get the country that owns the Bank
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function country(): BelongsTo
    {
        return $this->belongsTo(Country::class, 'country_id', 'id');
    }
}
