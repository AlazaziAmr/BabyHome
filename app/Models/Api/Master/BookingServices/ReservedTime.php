<?php

namespace App\Models\Api\Master\BookingServices;

use App\Models\Api\Nurseries\Nursery;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
/*use Spatie\Translatable\HasTranslations;*/

class ReservedTime extends Model
{
    use HasFactory,SoftDeletes;
/*    use HasTranslations;*/

    protected $fillable = [
        'nursery_id',
        'date',
        'start_hour',
        'end_hour',
        'num_of_confirmed_res',
        'num_of_unconfirmed_res',

    ];

    /*
     * 'num_of_confirmed',
     *  'num_of_unconfirmed_res'
     * 1=>ok
     * 2=>reject
     * 0=>No action
     * */


    public function Nurseries(): HasMany
    {
        return $this->HasMany(Nursery::class, 'id', 'nursery_id');
    }
}
