<?php

namespace App\Http\Resources\Api\Admin\Inspections;

use Illuminate\Http\Resources\Json\JsonResource;

class AdminInspectionResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'nursery_id' => $this->nursery['id'],
            'owner' => $this->nursery['owner']['name'],
            'from' => $this->from,
            'to' => $this->to,
            'notes' => $this->notes,
            'status' => $this->status,
        ];
    }
}
