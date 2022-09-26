<?php

namespace App\Models\Api\Nurseries\JoinRequest;

use App\Models\Api\Generals\Activity;
use App\Models\Api\Master\Child;
use App\Models\Api\Nurseries\PackageInfo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class JoinRequest extends Model
{
    use HasFactory;

    protected $fillable = [
        'nursery_id',
        'master_id',
        'joining_date'
    ];

    /**
     * The children that belong to the JoinRequest
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function children(): BelongsToMany
    {
        return $this->belongsToMany(Child::class, 'join_request_childrens', 'join_request_id', 'child_id')->withTimestamps();
    }


    /**
     * The activities that belong to the JoinRequest
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function activities(): BelongsToMany
    {
        return $this->belongsToMany(Activity::class, 'join_request_activities', 'join_request_id', 'activity_id')->withTimestamps();
    }

    /**
     * The packages that belong to the JoinRequest
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function packages(): BelongsToMany
    {
        return $this->belongsToMany(PackageInfo::class, 'join_request_packages', 'join_request_id', 'package_id')->withTimestamps();
    }
}
