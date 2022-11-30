<?php

namespace App\Http\Resources\Api\Master\Children;

use Illuminate\Http\Resources\Json\JsonResource;

class ChildPhoneResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'child_id' => $this->child_id,
            'relation_type' => $this->relationType->name,
            'phone' => $this->phone,
            'name' => $this->name,
        ];
    }
}
