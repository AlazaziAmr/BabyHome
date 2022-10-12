<?php

namespace App\Http\Resources\Api\Nurseries;

use Illuminate\Http\Resources\Json\JsonResource;

class BabysitterQulificationResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'babysitter_id' => $this->babysitter_id,
            'qualification_id' => $this->qualification_id,
            'description' => $this->description,
            'qualification' => ($this->qualification) ? $this->qualification->name : '',
        ];
    }
}
