<?php

namespace App\Models\Api\Generals;

use App\Models\BaseModel;
use Spatie\Translatable\HasTranslations;

class Qualification extends BaseModel
{
    use HasTranslations;

    public $translatable = ['name'];

    protected $fillable = [
        'name'
    ];
}
