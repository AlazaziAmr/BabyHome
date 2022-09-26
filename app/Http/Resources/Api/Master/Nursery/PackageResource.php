<?php

namespace App\Http\Resources\Api\Master\Nursery;

use Illuminate\Http\Resources\Json\JsonResource;

class PackageResource extends JsonResource
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
            'name' => $this->name,
            'capacity' => $this->capacity,
            'from_hour' => $this->from_hour,
            'to_hour' => $this->to_hour,
            'total_price' => $this->total_price,
            'type' => $this->type['name'],
        ];
    }
}
