<?php

namespace App\Models\Api\Master;

use App\Models\Api\Generals\Attachment;
use App\Models\Api\Generals\Gender;
use App\Models\BaseModel;
use App\Models\Api\Generals\Language;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Storage;

class Child extends BaseModel
{
    use HasFactory;

    protected $fillable = [
        'name',
        'gender_id',
        'relation_id',
        'date_of_birth',
        'description',
        'has_disability'
    ];
    protected $hidden = ['created_at','updated_at'];


    /**
     * Get the child master.
     */
    public function master()
    {
        return $this->hasOneThrough(Master::class, ChildMaster::class, 'child_id', 'id', 'id', 'master_id');
    }

    /**
     * The languages that belong to the Child
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function languages(): BelongsToMany
    {
        return $this->belongsToMany(Language::class, 'children_languages', 'child_id', 'language_id')->withTimestamps();
    }

    /**
     * Get the gender that owns the Child
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function gender(): BelongsTo
    {
        return $this->belongsTo(Gender::class, 'gender_id');
    }

    /**
     * Get all of the phones for the Child
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function phones(): HasMany
    {
        return $this->hasMany(Phone::class, 'child_id', 'id');
    }


    public function attachmentable()
    {
        return $this->morphMany(Attachment::class, 'attachmentable');
    }

    public function getMainAttachmentAttribute()
    {

        if (filled($this->attachmentable)) {
            foreach ($this->attachmentable as $image) {
                return asset('storage/children/' . $image->path);
            }
        }
        return null;
    }

    public function getAgeAttribute()
    {
        if ($this->date_of_birth)
            return Carbon::createFromDate($this->date_of_birth)->diff(Carbon::now())->format("%y سنة, %m شهر و %d يوم");
        else
            return 'Unknown';
    }


    /**
     * Get the child Created At.
     *
     * @param string $value
     * @return string
     */
    public function getCreatedAtAttribute($value)
    {
        return Carbon::createFromDate($value)->translatedFormat('j M, Y - g:i a');
    }

    public function sicknesses()
    {
        return $this->hasMany(ChildSickness::class);
    }

    public function allergies()
    {
        return $this->hasMany(ChildAllergy::class);
    }

    public static function boot()
    {
        parent::boot();

        static::deleting(function ($children) {
            foreach ($children->attachmentable()->get() as $attachment) {
                $attachment->delete();
            }
            $children->languages()->detach();
//            foreach ($children->languages()->detach() as $language) {
//                $language->detach();
//            }
            foreach ($children->phones()->get() as $phones) {
                $phones->delete();
            }
            foreach ($children->sicknesses()->get() as $sicknesses) {
                $sicknesses->delete();
            }
            foreach ($children->allergies()->get() as $allergies) {
                $allergies->delete();
            }
        });
    }
}
