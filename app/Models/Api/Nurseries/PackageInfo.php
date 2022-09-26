<?php

namespace App\Models\Api\Nurseries;

use App\Models\BaseModel;
use App\Models\Api\Generals\Day;
use App\Models\Api\Generals\PackagesType;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\Translatable\HasTranslations;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class PackageInfo extends BaseModel
{
    use HasTranslations;

    public $translatable = ['name'];

    protected $fillable = [
        'name',
        'description',
        'capacity',
        'from_hour',
        'to_hour',
        'total_price',
        'type_id',
        'nursery_id',
        'bundle_renew_after',
        'is_active',
    ];


    /**
     * The days that belong to the PackageInfo
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function days(): BelongsToMany
    {
        return $this->belongsToMany(Day::class, 'packages_available_days', 'package_id', 'day_id')->withTimestamps();
    }


    /**
     * Get the type that owns the PackageInfo
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function type(): BelongsTo
    {
        return $this->belongsTo(PackagesType::class, 'type_id', 'id');
    }
}
