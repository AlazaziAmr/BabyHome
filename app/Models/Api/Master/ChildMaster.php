<?php

namespace App\Models\Api\Master;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChildMaster extends Model
{
    use HasFactory;
    protected $table = 'master_children';

}
