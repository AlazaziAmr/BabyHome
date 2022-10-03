<?php

namespace App\Http\Resources\Api\Nurseries\Profile;

use Illuminate\Http\Resources\Json\JsonResource;

class SkillResource extends JsonResource
{

    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'description' => $this->description,
            'babysitter_id', $this->babysitter_id,
        ];
    }
}
