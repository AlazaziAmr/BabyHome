<?php

namespace App\Http\Resources\Api\Master\Children;

use Illuminate\Http\Resources\Json\JsonResource;

class ChildAllergyResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'child_id' => $this->child_id,
            'allergy_name' => $this->allergy_name,
        ];
    }
}
