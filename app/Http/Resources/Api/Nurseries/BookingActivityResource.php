<?php

namespace App\Http\Resources\Api\Nurseries;

use App\Http\Resources\Api\Generals\LanguageResource;
use App\Http\Resources\Api\Generals\NameResource;
use App\Http\Resources\Api\Generals\NationalityResource;
use Illuminate\Http\Resources\Json\JsonResource;

class BookingActivityResource extends JsonResource
{
    public function toArray($attended)
    {
        $data = [
            'attended' => [
                'services_is'=>$this->service_id,
                'name'=>$this->services->name,
                'description'=>$this->services->description,
                'price'=>$this->services->price,
                'is_paid'=>$this->services->is_paid,
            ],
        ];


        return $data;
    }
}
