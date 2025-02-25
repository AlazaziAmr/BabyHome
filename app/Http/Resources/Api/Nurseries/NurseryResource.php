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
            'user_id' => $this->user_id,
            'name' => $this->name,
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'license_no' => $this->license_no,
            'gender' => $this->gender,
            'card_expiration_date' => $this->card_expiration_date,
            'capacity' => $this->capacity,
            'acceptance_age_type' => $this->acceptance_age_type,
            'acceptance_age_from' => $this->acceptance_age_from,
            'acceptance_age_to' => $this->acceptance_age_to,
            'country' => $this->country['name'],
            'city' => $this->city['name'],
            'city_id' => $this->city_id,
            'email' => $this->owner['email'],
            'email-verified' => $this->owner['email_verified_at'] != null ? 1 : 0,
            'neighborhood' => $this->neighborhood['name'],
            'neighborhood_id' => $this->neighborhood_id,
            'national_address' => $this->national_address,
            'address_description' => $this->address_description,
            "location" => [
                "latitude" => $this->latitude,
                "longitude" => $this->longitude
            ],
            'building_type' => $this->building_type,
            'price' => $this->price,
            'online' => $this->online ? 'متصل' : 'غير متصل',
            'online_status' => $this->online,
            'created_at' => $this->created_at,
        ];
    }
}
