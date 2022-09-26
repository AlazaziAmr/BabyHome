<?php

namespace App\Models\Api\Admin\Inspections;

use App\Models\Api\Admin\Admin;
use App\Models\BaseModel;
use App\Models\Api\Generals\Attachment;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class InspectionResult extends BaseModel
{
    protected $table = 'inspection_results';

    protected $fillable = [
        'inspection_id',
        'latitude',
        'longitude'
    ];

    /**
     * Get the admin who submit the result.
     */
    public function inspector()
    {
        return $this->hasOneThrough(Admin::class, Inspection::class, 'inspector_id', 'id', 'inspection_id', 'id');
    }
    /**
     * Get all of the details for the InspectionResult
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function details(): HasMany
    {
        return $this->hasMany(InspectionResultDetail::class, 'inspection_result_id', 'id');
    }

    public function attachmentable()
    {
        return $this->morphMany(Attachment::class, 'attachmentable');
    }

    public function getMainAttachmentAttribute()
    {

        if (filled($this->attachmentable)) {
            foreach ($this->attachmentable as $image) {
                return asset('storage/inspections-results/' . $image->path);
            }
        }
        return null;
    }
}
