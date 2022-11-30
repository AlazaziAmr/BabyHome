<?php

namespace App\Models\Api\Nurseries;

use App\Models\Api\Master\Child;
use App\Models\Api\Master\Master;
use App\Models\BaseModel;
use App\Models\Api\Generals\Day;
use App\Models\Api\Generals\PackagesType;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\Translatable\HasTranslations;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Presence extends BaseModel
{

    protected $fillable = [
        'child_id',
        'nursery_id',
        'from_hour',
        'to_hour',
        'master_id',
        'day',
        'date',
        'check',
    ];


    /**
     * The days that belong to the daysTable
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function days(): BelongsTo
    {
        return $this->belongsTo(Day::class, 'day','id');
    }


    /**
     * Get the Nursery that owns the Nursery table
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function nursery(): BelongsTo
    {
        return $this->belongsTo(Nursery::class, 'nursery_id', 'id');
    }

    /**
     * Get the master that owns the Master table
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function master(): BelongsTo
    {
        return $this->belongsTo(Master::class, 'master_id', 'id');
    }

    /**
     * Get the child that owns the Children table
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function child(): BelongsTo
    {
        return $this->belongsTo(Child::class, 'child_id', 'id');
    }

}
