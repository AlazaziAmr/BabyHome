<?php

namespace App\Http\Resources\Api\Generals;

use Illuminate\Http\Resources\Json\JsonResource;

class AmenityResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'required' => $this->is_required ? true : false,
        ];
    }
}
