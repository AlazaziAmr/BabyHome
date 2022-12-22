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
            'activity' => [
                'id'=>$this->id,
                'name'=>$this->name,
                'description'=>$this->description,
                'is_paid'=>$this->is_paid,
                'is_active'=>$this->is_active,
            ],
        ];
       /* $data['child']=[
            $this->children->service_id->id
        ];*/


        return $data;
    }
}
