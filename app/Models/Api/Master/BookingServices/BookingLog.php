<?php

namespace App\Models\Api\Master\BookingServices;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class BookingLog extends Model
{
    use HasFactory,SoftDeletes;

    protected $fillable = [
        'user_id',
        'user_type',
        'booking_id',
        'status_id',

    ];

    /*
     * user_type
     * 1=>admin
     * 2=>master(parent)
     * 3=>nursery
     * */


    public function Booking(): BelongsTo
    {
        return $this->BelongsTo(Booking::class, 'booking_id', 'id');
    }
    public function status(): BelongsTo
    {
        return $this->BelongsTo(BookingsStatus::class, 'status_id', 'id');
    }

}
