<?php

namespace App\Models\Api\Master\BookingServices;

use App\Models\Api\Master\Booking\RejectResReasons;
use App\Models\Api\Master\Child;
use App\Models\Api\Master\Master;
use App\Models\Api\Nurseries\Nursery;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Translatable\HasTranslations;

class Booking extends Model
{
    use HasFactory,SoftDeletes;

    protected $fillable = [
        'id',
        'nursery_id',
        'master_id',
        'child_id',
        'status_id', #added - confirmed - rejected - paid - aborted - cancelled
        'booking_date',
        'start_datetime',
        'end_datetime',
        'total_hours',
        'created_by',
    ];


    public function nurseries(): BelongsTo
    {
        return $this->BelongsTo(Nursery::class, 'nursery_id', 'id');
    }
    public function masters(): BelongsTo
    {
        return $this->BelongsTo(Master::class, 'master_id', 'id');
    }
    public function children(): HasMany
    {
        return $this->hasMany(Child::class, 'id', 'child_id');
    }
    public function serviceBooking(): HasMany
    {
        return $this->hasMany(BookingService::class, 'booking_id', 'id');
    }
    public function BookingStatus(): BelongsTo
    {
        return $this->BelongsTo(BookingsStatus::class, 'status_id', 'id');
    }
    public function confirmed(): BelongsTo
    {
        return $this->BelongsTo(ConfirmedBooking::class, 'booking_id', 'id');
    }
    public function RejectResReasons(): HasMany
    {
        return $this->HasMany(RejectResReasons::class, 'booking_id', 'id');
    }
    public function reservedTimes(): HasMany
    {
        return $this->HasMany(ReservedTime::class, 'booking_id', 'id');
    }
}
