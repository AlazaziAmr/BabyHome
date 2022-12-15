<?php

namespace App\Http\Resources\Api\Nurseries;

use App\Http\Resources\Api\Generals\LanguageResource;
use App\Http\Resources\Api\Generals\NameResource;
use App\Http\Resources\Api\Generals\NationalityResource;
use Illuminate\Http\Resources\Json\JsonResource;

class BookingServiceResource extends JsonResource
{
    public function toArray($attended)
    {
        $images = array();
        if($this->attachmentable()) {
            foreach ($this->attachmentable()->get() as $index=>$image) {
                $images[$index]['id'] =  $image->id;
                $images[$index]['image_path'] =  asset('storage/booking_services/' . $image->path);
            }
        }
        $data = [
            'attended' => [
                'notes'=>$this->notes,
                'child_id'=>$this->children->id,
                'child'=>$this->children->name,
                'date_of_birth'=>$this->children->date_of_birth,
                'description'=>$this->children->description,
                'services'=>$this->services->name,
                'services_description'=>$this->services->description,
                'services_is_paid'=>$this->services->is_paid,
            ],
        ];
        $data['image'] = $images;


        return $data;
    }
}
