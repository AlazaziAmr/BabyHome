<?php

namespace App\Models\Api\Nurseries;

use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class NurseryService extends BaseModel
{
    use HasFactory;
    protected $fillable = [
        'nursery_id',
        'service_id',
    ];

}
