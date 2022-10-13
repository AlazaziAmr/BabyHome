<?php

namespace App\Http\Resources\Api\Nurseries;

use Illuminate\Http\Resources\Json\JsonResource;

class AllNurseriesResources extends JsonResource
{
    protected function paginationLinks($paginated)
    {
        return [
            'prev' => $paginated['prev_page_url'] ?? null,
            'next' => $paginated['next_page_url'] ?? null,
        ];
    }

    protected function meta($paginated)
    {
        $metaData = parent::meta($paginated);
        return [
            'current_page' => $metaData['current_page'] ?? null,
            'total_items' => $metaData['total'] ?? null,
            'per_page' => $metaData['per_page'] ?? null,
            'total_pages' => $metaData['total'] ?? null,
        ];
    }

    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'owner_name' => ($this->owner) ? $this->owner['name']  :'',
            'image' => '',
            'years_of_experince' => ($this->babysitter) ? $this->babysitter->years_of_experince  :'',
            'free_of_disease' => ($this->babysitter) ? $this->babysitter->free_of_disease  :'',
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
            'prev' => $paginated['prev_page_url'] ?? null,
            'next' => $paginated['next_page_url'] ?? null,
        ];
    }

    public function toResponse($request)
    {
        return JsonResource::toResponse($request);
    }
}
