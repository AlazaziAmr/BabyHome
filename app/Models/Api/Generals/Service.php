<?php

namespace App\Models\Api\Generals;

use App\Models\Api\Master\BookingServices\BookingService;
use App\Models\Api\Master\Child;
use App\Models\Api\Nurseries\Nursery;
use App\Models\BaseModel;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\Translatable\HasTranslations;

class Service extends BaseModel
{
    use HasTranslations;

    public $translatable = ['name'];
    protected $hidden = ['pivot','created_at','updated_at'];

    protected $fillable = [
        'name',
        'description',
        'price',
        'is_paid',
        'type_id',
        'is_active',
        'user_id',
        'sub_category_id',
    ];

    /**
     * Get the type that owns the Service
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function type(): BelongsTo
    {
        return $this->belongsTo(NurseryServiceType::class, 'type_id', 'id');
    }

    public function sub_type(): BelongsTo
    {
        return $this->belongsTo(NurseryServiceType::class, 'sub_category_id', 'id');
    }

    public function booking_service(){
        return $this->hasMany(BookingService::class,'service_id','id');
    }

    public function nurseryTodayBookingService(){
        $nursery = Nursery::where('user_id',user()->id)->first();
        return $this->hasMany(BookingService::class,'service_id','id')->where(['nursery_id'=>$nursery->id,'created_at'=>Carbon::today()]);
    }

//    public function children(){
//        return $this->hasManyThrough(BookingService::class,Child::class,'service_id','id');
//    }

    public function attachmentable()
    {
        return $this->morphMany(Attachment::class, 'attachmentable');
    }


    public function getMainAttachmentAttribute()
    {

        if (filled($this->attachmentable)) {
            foreach ($this->attachmentable as $image) {
                return asset('storage/services/' . $image->path);
            }
        }
        return null;
    }

    public static function boot()
    {
        parent::boot();

        static::deleting(function ($service) {
            foreach ($service->attachmentable()->get() as $attachment) {
                $attachment->delete();
            }
        });
    }
}
