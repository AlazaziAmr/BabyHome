<?php

namespace App\Models\Api\Master;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Phone extends Model
{
    use HasFactory;
    protected $table = 'children_phones';
    protected $fillable = [
        'child_id',
        'phone',
    ];
}
