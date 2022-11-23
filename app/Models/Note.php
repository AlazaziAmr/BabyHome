<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Note extends Model
{
    use HasFactory;

    protected $fillable = [
        'notes',
        'master_id',
        'nursery_id',
        'status',
        'user_type',
    ];
    protected $hidden = ['pivot'];

}
