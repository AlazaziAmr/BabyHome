<?php

namespace App\Models\Api\Generals;

use App\Models\BaseModel;
use App\Models\Api\Generals\Activity;
use Spatie\Translatable\HasTranslations;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class NurseryServiceType extends BaseModel
{
    use HasTranslations;

    public $translatable = ['name'];

    protected $fillable = [
        'name',
        'description',
        'parent_id',
    ];


    /**
     * Get all of the activities for the NurseryServiceType
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function activities(): HasMany
    {
        return $this->hasMany(Activity::class, 'type_id', 'id')->where('user_id', null);
    }

    /**
     * Get the parent that owns the NurseryServiceType
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function parent(): BelongsTo
    {
        return $this->belongsTo(NurseryServiceType::class, 'parent_id');
    }

    /**
     * Get all of the children for the NurseryServiceType
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function children(): HasMany
    {
        return $this->hasMany(NurseryServiceType::class, 'parent_id');
    }
}
