<?php

namespace App\Models;

use App\Models\Api\Master\Child;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Note extends Model
{
    use HasFactory;

    protected $fillable = [
        'notes',
        'master_id',
        'nursery_id',
        'child_id',
        'status',
        'user_type',
    ];
    protected $hidden = ['pivot'];
    public function children()
    {
        return $this->BelongsTo(Child::class, 'child_id', 'id');

    }

}
