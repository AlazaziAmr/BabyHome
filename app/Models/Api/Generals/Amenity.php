<?php

namespace App\Models\Api\Generals;

use App\Models\BaseModel;

use Spatie\Translatable\HasTranslations;

class Amenity extends BaseModel
{
    use HasTranslations;
    protected $hidden = ['pivot'];

    public $translatable = ['name'];

    protected $fillable = [
        'name',
        'is_required',
    ];
}
