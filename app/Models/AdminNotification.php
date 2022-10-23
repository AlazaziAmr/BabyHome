<?php

namespace App\Models;


use App\Models\Api\Admin\Admin;

class AdminNotification extends BaseModel
{
    protected $fillable = [
        'notifiable_type',
        'notifiable_id',
        'title',
        'description',
        'link',
        'mark_as_read',
        'type'
    ];

    public function admin(){
        return $this->belongsTo(Admin::class,'notifiable_id ','id');
    }
}
