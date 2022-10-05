<?php

namespace App\Http\Resources\Api\Nurseries;

use Illuminate\Http\Resources\Json\JsonResource;

class NurseryResource extends JsonResource
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
            'capacity' => $this->capacity,
            'acceptance_age_type' => $this->acceptance_age_type,
            'acceptance_age_from' => $this->acceptance_age_from,
            'acceptance_age_to' => $this->acceptance_age_to,
            'country' => $this->country['name'],
            'city' => $this->city['name'],
            'neighborhood' => $this->neighborhood['name'],
            'national_address' => $this->national_address,
            'address_description' => $this->address_description,
            "location" => [
                "latitude" => $this->latitude,
                "longitude" => $this->longitude
            ],
            'building_type' => $this->building_type,
            'price' => $this->price,
        ];
    }
}
