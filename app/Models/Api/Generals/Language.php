<?php

namespace App\Models\Api\Generals;

use App\Models\BaseModel;
use Spatie\Translatable\HasTranslations;

class Language extends BaseModel
{
    use HasTranslations;

    public $translatable = ['name'];
    protected $hidden = ['created_at','updated_at','pivot'];



    protected $fillable = [
        'name',
        'logo',
    ];
}
