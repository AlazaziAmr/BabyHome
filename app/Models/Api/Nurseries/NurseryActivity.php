<?php

namespace App\Models\Api\Nurseries;

use App\Models\Api\Generals\Activity;
use App\Models\Api\Master\Child;
use App\Models\Api\Master\Master;
use App\Models\BaseModel;
use App\Models\Api\Generals\Day;
use App\Models\Api\Generals\PackagesType;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\Translatable\HasTranslations;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class NurseryActivity extends BaseModel
{

    protected $fillable = [
        'activity_id',
        'nursery_id',
    ];


    /**
     * The activity that belong to the activity
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function activity(): BelongsTo
    {
        return $this->belongsTo(Activity::class, 'activity_id','id');
    }


}
