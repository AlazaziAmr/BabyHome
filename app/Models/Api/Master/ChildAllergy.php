<?php

namespace App\Models\Api\Master;

use App\Models\BaseModel;


class ChildAllergy extends BaseModel
{
    protected $fillable = [
        'child_id',
        'allergy_name',
    ];
    protected $hidden = ['created_at','updated_at'];

}
