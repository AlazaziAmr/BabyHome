<?php

namespace App\Models\Api\Master;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Phone extends Model
{
    use HasFactory;
    protected $table = 'children_phones';
    protected $fillable = [
        'child_id',
        'phone',
        'relation_type',
        'name'
    ];
  /*  public function gender(): BelongsTo
    {
        return $this->belongsTo(Relative::class, 'relation_type','id');
    }*/
}
