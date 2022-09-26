<?php

namespace App\Http\Resources\Api\Generals;

use Illuminate\Http\Resources\Json\JsonResource;

class NationalityResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
        ];
    }
}
