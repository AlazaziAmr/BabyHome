<?php

namespace App\Models\Api\Generals;

use App\Models\BaseModel;
use Spatie\Translatable\HasTranslations;

class Activity extends BaseModel
{
    use HasTranslations;

    public $translatable = ['name'];

    protected $fillable = [
        'name',
        'description',
        'unit',
        'price',
        'is_paid',
        'type_id',
        'is_active',
        'user_id',
        'nursery_id',
    ];


    public function attachmentable()
    {
        return $this->morphMany(Attachment::class, 'attachmentable');
    }


    public function getMainAttachmentAttribute()
    {

        if (filled($this->attachmentable)) {
            foreach ($this->attachmentable as $image) {
                return asset('storage/activities/' . $image->path);
            }
        }
        return null;
    }

}
