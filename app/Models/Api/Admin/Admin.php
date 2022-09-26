<?php

namespace App\Models\Api\Admin;

use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Api\Admin\Inspections\Inspection;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\DB;

class Admin extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes, HasRoles;

    protected $guard = 'admin';
    protected $fillable = [
        'name', 'username', 'email', 'phone', 'password', 'fcm_token'
    ];

    protected $hidden = [
        'password',
    ];
    /**
     * Get all of the inspectionOrders for the Admin
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function inspectionOrders(): HasMany
    {
        return $this->hasMany(Inspection::class, 'inspector_id', 'id');
    }

    public function notifiable()
    {
        return $this->morphMany(AdminNotification::class, 'notifiable');
    }

    public function count()
    {
        return $this->notifiable()->where('mark_as_read', 0)->count();
    }

    public function notificationsWithCount()
    {
        return $this->notifiable()->select(['id', 'title', 'description', 'link', 'mark_as_read']);
    }
}
