<?php

namespace App\Http\Resources\Api\Nurseries\Profile;

use Illuminate\Http\Resources\Json\JsonResource;

class ActivityResource extends JsonResource
{

    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'description' => $this->description,
            'unit' => $this->unit,
            'price' => $this->price,
            'is_paid' => $this->is_paid,
            'type_id' => $this->type_id,
            'is_active' => $this->is_active,
        ];
    }
}
