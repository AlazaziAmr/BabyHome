<?php

namespace App\Models\Api\Nurseries;

use App\Models\Api\Generals\Utility;
use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class NurseryUtility extends BaseModel
{
    use HasFactory;
    protected $fillable = [
        'nursery_id',
        'utility_id',
    ];

    public function utility(){
        return $this->belongsTo(Utility::class);
    }
}
