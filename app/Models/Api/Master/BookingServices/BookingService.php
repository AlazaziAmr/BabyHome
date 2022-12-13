<?php

namespace App\Models\Api\Master\BookingServices;

use App\Models\Api\Generals\Attachment;
use App\Models\Api\Generals\Service;
use App\Models\Api\Master\Master;
use App\Models\Api\Nurseries\Nursery;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
/*use Spatie\Translatable\HasTranslations;*/

class BookingService extends Model
{
    use HasFactory,SoftDeletes;
/*    use HasTranslations;*/

    protected $fillable = [
        'nursery_id',
        'booking_id',
        'service_id',
        'master_id',
        'child_id',
        'service_type_id',
        'service_price',
        'service_quantity',
        'notes',
        'status',
    ];
    protected $hidden = ['created_at','updated_at'];



    public function nurseries(): HasMany
    {
        return $this->HasMany(Nursery::class, 'nursery_id', 'id');
    }
    public function Booking(): BelongsTo
    {
        return $this->BelongsTo(Booking::class, 'booking_id', 'id');
    }
    public function services(): BelongsTo
    {
        return $this->BelongsTo(Service::class, 'service_id', 'id');
    }
    public function Master(): BelongsTo
    {
        return $this->BelongsTo(Master::class, 'master_id', 'id');
    }
    public function children(): BelongsTo
    {
        return $this->BelongsTo(BelongsTo::class, 'child_id', 'id');
    }
    public function attachmentable()
    {
        return $this->morphMany(Attachment::class, 'attachmentable');
    }
    public function service(): BelongsTo
    {
        /*        return $this->hasManyThrough(Amenity::class, NurseryAmenity::class, 'nursery_id',  'id', 'id', 'amenity_id');*/
        return $this->belongsTo(Service::class,  'service_id',  'id');

    }

}
