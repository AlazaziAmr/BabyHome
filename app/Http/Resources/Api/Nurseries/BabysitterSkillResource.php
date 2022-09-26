<?php

namespace App\Http\Resources\Api\Nurseries;

use Illuminate\Http\Resources\Json\JsonResource;

class BabysitterSkillResource  extends JsonResource
{
    public function toArray($request)
    {
        return [
            'description' => $this->description,
            'babysitter_id' => $this->babysitter_id
        ];
    }
}
