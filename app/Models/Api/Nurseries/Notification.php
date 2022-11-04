<?php

namespace App\Models\Api\Nurseries;

use App\Models\BaseModel;


class Notification extends BaseModel
{
    protected $fillable = [
        'user_id',
        'title',
        'message',
    ];
}
