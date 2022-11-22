<?php

namespace App\Models\Api\Master;

use App\Models\Api\Generals\Relation;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Api\Generals\Relation;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Phone extends Model
{
    use HasFactory;
    protected $table = 'children_phones';
    protected $fillable = [
        'child_id',
        'phone',
        'relation_type',
    ];
    public function gender(): BelongsTo
    {
        return $this->belongsTo(Relation::class, 'relation_type','id');
    }
}
