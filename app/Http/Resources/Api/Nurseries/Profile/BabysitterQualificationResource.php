<?php

namespace App\Http\Resources\Api\Nurseries\Profile;

use Illuminate\Http\Resources\Json\JsonResource;

class BabysitterQualificationResource extends JsonResource
{

    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'babysitter_id' => $this->babysitter_id,
            'qualification_id' => $this->qualification_id,
            'qualification' => ($this->qualification) ? $this->qualification->name : '',
        ];
    }

}
