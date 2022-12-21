<?php

namespace App\Http\Resources\Api\Master\Booking;

use App\Http\Resources\Api\Generals\LanguageResource;
use App\Http\Resources\Api\Generals\NameResource;
use App\Http\Resources\Api\Generals\NationalityResource;
use Illuminate\Http\Resources\Json\JsonResource;

class ShowBookingServiceMasterResource extends JsonResource
{
    public function toArray($attended)
    {

        $data = [
                'id'=>$this->id,
                'notes'=>$this->notes,
                'status'=>$this->status,
                'Booking_id'=>$this->Booking_id,
                'complete'=>$this->complete,
                'master_id'=>$this->master_id,
                'services'=>$this->services->name,
                'services_description'=>$this->services->description,
                'services_is_paid'=>$this->services->is_paid,
        ];


        return $data;
    }
}
