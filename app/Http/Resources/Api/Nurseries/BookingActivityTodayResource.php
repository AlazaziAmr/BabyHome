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

        $children = array();
        $images = array();
        $details = array();
        foreach($this->booking_service as $k => $kids){
            $details[$k]['id'] = $kids->id;
            $details[$k]['service_id'] = $kids->service_id;
            $details[$k]['booking_id'] = $kids->booking_id;
            $details[$k]['child_id'] = $kids->child_id;
            foreach($kids->childrens()->get() as $kid) {
                $children[$k]['id'] = $kid->id;
                $children[$k]['name'] = $kid->name;
//                foreach( as $k => $childImages) {
//                    $images[$k]['id'] =  $childImages->id;
//                    $images[$k]['image_path'] =  asset('storage/children/' . $childImages->path);
//                }
                $children[$k]['image'] = env('APP_URL').'/storage/children/'.$kid->attachmentable()->first()->path;
//                $children[$k]['id'] = $kid->id;
            }
        }

        $data = [
            'activity' => [
                'id'=>$this->id,
                'booking_service_details' => $details,
                'name'=>$this->name,
                'description'=>$this->description,
                'is_paid'=>$this->is_paid,
                'is_active'=>$this->is_active,
                'image' => $this->mainAttachment,
                'child' => $children,
            ],
        ];

       /* $data['child']=[
            $this->children->service_id->id
        ];*/


        return $data;
    }
}
