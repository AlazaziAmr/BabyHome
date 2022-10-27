<?php

namespace App\Http\Resources\Api\Nurseries\Profile;

use Illuminate\Http\Resources\Json\JsonResource;

class NurseryAmenityResource extends JsonResource
{

    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => ($this->amenity) ? $this->amenity->name : '',
            'required' => ( $this->amenity and $this->amenity->is_required ) ? true : false,
            'images' => $this->getImages()
        ];
    }
}
