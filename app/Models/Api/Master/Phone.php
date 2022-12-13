<?php

namespace App\Models\Api\Master;

use App\Models\Api\Generals\Relation;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Phone extends Model
{
    use HasFactory,SoftDeletes;
    protected $table = 'children_phones';
    protected $fillable = [
        'child_id',
        'phone',
        'relation_type',
        'name'
    ];
    protected $hidden = ['created_at','updated_at'];


    public function relationType(): BelongsTo
    {
        return $this->belongsTo(Relation::class,'relation_type','id');
    }
  /*  public function gender(): BelongsTo
    {
        return $this->belongsTo(Relative::class, 'relation_type','id');
    }*/
}
