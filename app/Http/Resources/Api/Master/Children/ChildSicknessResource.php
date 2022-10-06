<?php

namespace App\Http\Resources\Api\Master\Children;

use Illuminate\Http\Resources\Json\JsonResource;

class ChildSicknessResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'child_id' => $this->child_id,
            'sickness_name' => $this->sickness_name,
            'sickness_date' => $this->sickness_date,
            'sickness_desc' => $this->sickness_desc,
            'sickness_status' => $this->sickness_status,
        ];
    }
}
