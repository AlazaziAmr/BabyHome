<?php

namespace App\Models\Api\Master\BookingServices;

use App\Models\Api\Master\Child;
use App\Models\Api\Master\Master;
use App\Models\Api\Nurseries\Nursery;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Translatable\HasTranslations;

class Booking extends Model
{
    use HasFactory,SoftDeletes;

    protected $fillable = [
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
    public function children(): BelongsTo
    {
        return $this->BelongsTo(Child::class, 'child_id', 'id');
    }
    public function BookingStatus(): BelongsTo
    {
        return $this->BelongsTo(BookingsStatus::class, 'status_id', 'id');
    }
}
