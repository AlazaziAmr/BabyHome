<?php

namespace App\Models\Api\Nurseries;

use App\Models\Api\Generals\Day;
use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class NurseryAvailability extends BaseModel
{
    use HasFactory;
    protected $fillable = [
        'nursery_id',
        'day_id',
        'from_hour',
        'to_hour',
    ];

    public function day(){
        return $this->belongsTo(Day::class);
    }
}
