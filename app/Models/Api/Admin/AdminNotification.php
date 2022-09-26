<?php

namespace App\Models\Api\Admin;

use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AdminNotification extends BaseModel
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'link',
        'mark_as_read',
    ];
}
