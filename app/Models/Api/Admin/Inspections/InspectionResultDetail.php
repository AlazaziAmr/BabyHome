<?php

namespace App\Models\Api\Admin\Inspections;

use App\Models\BaseModel;

class InspectionResultDetail extends BaseModel
{
    protected $table = 'inspection_result_details';

    protected $fillable = [
        'inspection_result_id',
        'criteria',
        'rating',
        'matching',
        'recommendation',
        'comment',
    ];

    protected $criteria = [
        0 => 'amenities',
        1 => 'babySetter',
        2 => 'nurseryInfo',
        3 => 'utilities',
        4 => 'services',
    ];

    protected $recommendation = [
        1 => 'recommended',
        2 => 'not_recommended',
    ];

    protected $matching = [
        1 => 'matched',
        2 => 'partially_matched',
        3 => 'not_matched',
    ];

    public function setCriteriaAttribute($value)
    {
        return  $this->attributes['criteria']  = array_search($value, $this->criteria);
    }
//    public function getCriteriaAttribute($value)
//    {
//        return trans('responses.' . $this->criteria[$value]);
//    }
    public function getMatchingAttribute($value)
    {
        return trans('responses.' . $this->matching[$value]);
    }
    public function getRecommendationAttribute($value)
    {
        return trans('responses.' . $this->recommendation[$value]);
    }
}
