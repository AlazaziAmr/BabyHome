<?php

namespace App\Models\Api\Nurseries;

use App\Models\Api\Generals\Amenity;
use App\Models\Api\Generals\Attachment;
use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class NurseryAmenity extends  BaseModel
{
    use HasFactory;
    protected $hidden = ['pivot'];

    protected $fillable = [
        'nursery_id',
        'amenity_id',
    ];


    public function attachmentable()
    {
        return $this->morphMany(Attachment::class, 'attachmentable');
    }


    public function getMainAttachmentAttribute()
    {
        if (filled($this->attachmentable)) {
            foreach ($this->attachmentable as $image) {
                return asset('storage/amenities/' . $image->path);
            }
        }
        return null;
    }

    public function getImages()
    {
        $images = array();
        if (filled($this->attachmentable)) {
            foreach ($this->attachmentable as $index=>$image) {
                $images[$index]['id'] = $image->id;
                $images[$index]['image_path'] = asset('storage/amenities/' . $image->path);
            }
        }

        return $images;
    }

    /**
     * Get the amenity that owns the NurseryAmenity
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function amenity(): BelongsTo
    {
        return $this->belongsTo(Amenity::class, 'amenity_id', 'id');
    }


    public static function boot()
    {
        parent::boot();

        static::deleting(function ($nurseryAmenity) {
            foreach ($nurseryAmenity->attachmentable()->get() as $attachment) {
                $attachment->delete();
            }
            $nurseryAmenity->amenity()->delete();
        });
    }
}
