<?php

namespace App\Http\Resources\Api\Nurseries;

use App\Http\Resources\Api\Generals\LanguageResource;
use App\Http\Resources\Api\Generals\NameResource;
use App\Http\Resources\Api\Generals\NationalityResource;
use Illuminate\Http\Resources\Json\JsonResource;

class BookingServiceResource extends JsonResource
{
    public function toArray($request,$booking)
    {

        $images = array();
        if($this->booking['booking_services']->attachmentable()) {
            foreach ($this->booking['booking_services']->attachmentable()->get() as $index=>$image) {
                $images[$index]['id'] =  $image->id;
                $images[$index]['image_path'] =  asset('storage/booking_services/' . $image->path);
            }
        }
        $data = [
            'booking' => [
                'id' => $this->id,
                'child_id' => $this->booking->children->id,
                'confirmDates' => $this->confirm_date,
                'name' => $this->booking->children->name,
                'dateOfBirth' => $this->booking->children->date_of_birth,
                'description' => $this->booking->children->description,
                'gender' => $this->booking->children->gender_id,
                'image' => $images,
            ],
        ];



        return $data;
    }
}
