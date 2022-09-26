<?php

namespace App\Models\Api\Generals;

use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Media  extends BaseModel
{
    use HasFactory;
    protected $fillable = ['id', 'mediaable_type', 'mediaable_id', 'storage', 'path'];
}
