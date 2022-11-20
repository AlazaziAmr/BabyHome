<?php

namespace App\Models\Api\Master\NurseryAccounts;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Translatable\HasTranslations;

class SystemAccount extends Model
{
    use HasFactory,SoftDeletes;
    use HasTranslations;

    protected $fillable = [
        'account_name',
        'account_number',
        'balance',
    ];}
