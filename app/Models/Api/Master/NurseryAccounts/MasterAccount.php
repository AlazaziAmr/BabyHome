<?php

namespace App\Models\Api\Master\NurseryAccounts;

use App\Models\Api\Master\Master;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Translatable\HasTranslations;
use Yajra\DataTables\Html\Editor\Fields\BelongsTo;

class MasterAccount extends Model
{
    use HasFactory,SoftDeletes;
    use HasTranslations;

    protected $fillable = [
        'master_id',
        'account_number',
        'balance',

    ];

    public function Master(): BelongsTo
    {
        return $this->belongsTo(Master::class, 'master_id', 'id');
    }
}
