<?php

namespace App\Models\Api\Nurseries;

use App\Models\Api\Generals\Attachment;
use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class BabysitterSkill extends  BaseModel
{
    use HasFactory;

    protected $fillable = ['description', 'babysitter_id'];

    public function attachmentable()
    {
        return $this->morphMany(Attachment::class, 'attachmentable');
    }
}
