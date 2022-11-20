<?php

namespace App\Models\Api\Master\Booking;

use App\Models\Api\Parents\BookingServices\ConfirmedBooking;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Translatable\HasTranslations;

class Transaction extends Model
{
    use HasFactory,SoftDeletes;
    use HasTranslations;

    protected $fillable = [
        'confirmed_bookings_id',
        'transaction_id',
        'total_payment',
        'from_account',
        'to_account',
        'date',
        'notes',
    ];


    public function ConfirmedBooking(): HasMany
    {
        return $this->HasMany(ConfirmedBooking::class, 'confirmed_bookings_id', 'id');
    }
    public function TransactionTypes(): HasMany
    {
        return $this->HasMany(\TransactionTypes::class, 'transaction_id', 'id');
    }
}
