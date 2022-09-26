<?php

namespace App\Models\Api\Nurseries;

use App\Models\Api\Generals\Qualification;
use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class BabysitterQualification  extends BaseModel
{
    use HasFactory;

    protected $fillable = ['description', 'babysitter_id', 'qualification_id'];

    /**
     * Get the qualification that owns the BabysitterQualification
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function qualification(): BelongsTo
    {
        return $this->belongsTo(Qualification::class, 'qualification_id', 'id');
    }
}
