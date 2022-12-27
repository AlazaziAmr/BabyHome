<?php

namespace App\Models\Api\Nurseries;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    use HasFactory;
    protected $hidden = ['pivot'];


    protected $fillable = [
        'latitude',
        'longitude',
        'nursery_id',
        'user_id',
    ];
}
