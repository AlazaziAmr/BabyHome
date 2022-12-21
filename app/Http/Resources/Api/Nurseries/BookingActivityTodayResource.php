<?php

namespace App\Http\Resources\Api\Nurseries;

use App\Http\Resources\Api\Generals\LanguageResource;
use App\Http\Resources\Api\Generals\NameResource;
use App\Http\Resources\Api\Generals\NationalityResource;
use Illuminate\Http\Resources\Json\JsonResource;

class BookingActivityTodayResource extends JsonResource
{
    public function toArray($attended)
    {
        $data = [
            'attended' => [
                'id'=>$this->id,
            ],
        ];
        $data['child']=[
            $this->children->service_id->id
        ];


        return $data;
    }
}
