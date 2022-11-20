<?php

namespace App\Models\Api\Master\NurseryAccounts;

use App\Models\Api\Master\Master;
use App\Models\Api\Nurseries\Nursery;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Translatable\HasTranslations;
use Yajra\DataTables\Html\Editor\Fields\BelongsTo;

class NurseryAccount extends Model
{
    use HasFactory,SoftDeletes;
    use HasTranslations;

    protected $fillable = [
        'nursery_id',
        'account_number',
        'balance',

    ];

    public function Nurseries(): HasMany
    {
        return $this->HasMany(Nursery::class, 'nursery_id', 'id');
    }
}
