<?php

namespace App\Models\Api\Nurseries;

use App\Models\Api\Generals\Attachment;
use App\Models\Api\Generals\Language;
use App\Models\Api\Generals\Nationality;
use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class BabysitterInfo  extends BaseModel
{
    use HasFactory;
    protected $fillable = [
        'years_of_experince',
        'date_of_birth',
        'user_id',
        'free_of_disease',
        'nursery_id',
        'national_id',
        'nationality',
    ];

    /**
     * The languages that belong to the BabysitterInfo
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function languages(): BelongsToMany
    {
        return $this->belongsToMany(Language::class, 'babysitter_languages', 'babysitter_info_id', 'language_id')->withTimestamps();
    }

    public function attachmentable()
    {
        return $this->morphMany(Attachment::class, 'attachmentable');
    }


    public function getMainAttachmentAttribute()
    {

        if (filled($this->attachmentable)) {
            foreach ($this->attachmentable as $image) {
                return asset('storage/baby-sitters/' . $image->path);
            }
        }
        return null;
    }

    // /**
    //  * Get all of the qualifications for the BabysitterInfo
    //  *
    //  * @return \Illuminate\Database\Eloquent\Relations\HasManyThrough
    //  */
    // public function qualifications(): HasManyThrough
    // {
    //     return $this->hasManyThrough(Qualification::class, BabysitterQualification::class, 'qualification_id', 'id');
    // }

    /**
     * Get all of the qualifications for the BabysitterInfo
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function qualifications(): HasMany
    {
        return $this->hasMany(BabysitterQualification::class, 'babysitter_id', 'id');
    }

    /**
     * Get all of the qualifications for the BabysitterInfo
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function skills(): HasMany
    {
        return $this->hasMany(BabysitterSkill::class, 'babysitter_id', 'id');
    }

    // public static function boot()
    // {
    //     parent::boot();

    //     static::deleting(function ($obj) {

    //         foreach ($obj->attachmentable()->get() as $attachment) {
    //             $attachment->delete();
    //         }
    //         foreach ($obj->skills()->get() as $skill) {
    //             $skill->delete();
    //         }
    //         foreach ($obj->qualifications()->get() as $qualification) {
    //             $qualification->delete();
    //         }
    //         foreach ($obj->languages()->get() as $language) {
    //             $language->delete();
    //         }
    //     });
    // }

    public function nationalitydata(){
        return $this->belongsTo(Nationality::class,'nationality','id');
    }
}
