<?php

namespace App\Models\Api\Admin\Inspections;

use App\Models\Api\Admin\Admin;
use App\Models\Api\Nurseries\Nursery;
use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Inspection extends BaseModel
{
    protected $table = 'inspections';
    protected $fillable = [
        'nursery_id',
        'inspector_id',
        'notes',
        'from',
        'to',
        'status'
    ];
    protected $status = [
        0 => 'assigned',
        1 => 'inprogress',
        2 => 'incomplete',
        3 => 'completed',
    ];



    /**
     * Get the nursery that owns the Inspection
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function nursery(): BelongsTo
    {
        return $this->belongsTo(Nursery::class, 'nursery_id', 'id');
    }

    /**

    /**
     * Get the nursery that owns the Inspection
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function inspector(): BelongsTo
    {
        return $this->belongsTo(Admin::class, 'inspector_id', 'id');
    }

    /**
     * Get the result associated with the Inspection
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function result(): HasOne
    {
        return $this->hasOne(InspectionResult::class, 'inspection_id', 'id');
    }
    /**
     * Get the status.
     *
     * @param  string  $value
     * @return string
     */
    public function getStatusAttribute($value)
    {
        return $this->status[$value];
    }
}
