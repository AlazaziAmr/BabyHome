<?php

namespace App\Models\Api\Master;

use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChildSickness extends BaseModel
{
    protected $fillable = [
        'child_id',
        'sickness_name',
        'sickness_date',
        'sickness_desc',
        'sickness_status',
    ];
    protected $hidden = ['created_at','updated_at'];

}
