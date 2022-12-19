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
                'services_is'=>$this->servicesBooking->service_id,
                'name'=>$this->servicesBooking->services->name,
                'description'=>$this->servicesBooking->services->description,
                'price'=>$this->servicesBooking->services->price,
                'is_paid'=>$this->servicesBooking->services->is_paid,
            ],
        ];


        return $data;
    }
}
