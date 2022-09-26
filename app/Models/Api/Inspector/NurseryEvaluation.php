<?php

namespace App\Models\Api\Inspector;

use App\Models\Api\Generals\Attachment;
use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class NurseryEvaluation extends BaseModel
{
    use HasFactory;
    protected $fillable = [
        'nursery_id',
        'inspector_id',
        'criteria',
        'comment',
        'rating',
        'lat',
        'lng',
        'matching',
        'recommendation'
    ];

    protected $criteria = [
        0 => 'activities',
        1 => 'babySetter',
        2 => 'nurseryInfo',
        3 => 'packages',
    ];

    public function getCriteriaAttribute($value){
        return $this->criteria[$value];
    }

    public function attachmentable()
    {
        return $this->morphMany(Attachment::class, 'attachmentable');
    }
}
