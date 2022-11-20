<?php

namespace App\Models\Api\Master\Booking;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Translatable\HasTranslations;

class PaymentMethod extends Model
{
    use HasFactory;

    public $translatable = ['name'];
    use HasFactory,SoftDeletes;
    use HasTranslations;

    protected $fillable = [
        'name',
        'flag',
        'status',
    ];

}
