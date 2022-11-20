<?php

namespace App\Models\Api\Master\Booking;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Translatable\HasTranslations;

class TransactionType extends Model
{

    use HasFactory,SoftDeletes;
    use HasTranslations;
    public $translatable = ['name'];

    protected $fillable = [
        'name',
    ];

}
