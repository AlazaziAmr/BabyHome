<?php

namespace App\Models\Api\Generals;

use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Translatable\HasTranslations;

class Day extends BaseModel

{
    use HasFactory, HasTranslations;

    public $translatable = ['name'];
}
