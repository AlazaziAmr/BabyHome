<?php

namespace App\Models\Api\Master\Booking;

use App\Models\Api\Master\BookingServices\Booking;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Translatable\HasTranslations;

class RejectResReasons extends Model
{
    use HasFactory,SoftDeletes;

    protected $fillable = [
        'booking_id',
        'reason',
    ];
    public function Booking(): HasMany
    {
        return $this->HasMany(Booking::class, 'booking_id', 'id');
    }
}
