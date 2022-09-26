<?php

namespace App\Models\Api\Generals;

use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Attachment extends BaseModel
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'path',
    ];
}
