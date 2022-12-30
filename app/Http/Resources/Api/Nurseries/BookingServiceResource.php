<?php

namespace App\Http\Resources\Api\Nurseries;


use Illuminate\Http\Resources\Json\JsonResource;

class BookingServiceResource extends JsonResource
{
    public function toArray($attended)
    {

        $services = array();
        $attachmentable_services = array();
        $children = array();
        $images = array();
        if ($this->attachmentable()) {


            foreach ($this->services()->get() as $service => $serv) {
                $services[$service]['id'] = $serv->id;
                $services[$service]['name'] = $serv->name;
                $services[$service]['description'] = $serv->description;
                $services[$service]['is_paid'] = $serv->is_paid;
                $services[$service]['price'] = $serv->price;

                foreach ($serv->attachmentable()->get() as $attachmentables => $attachmentable) {
                    $attachmentable_services[$attachmentables]['id'] = $attachmentable->id;
                    $attachmentable_services[$attachmentables]['image_path'] = asset('storage/services/' . $attachmentable->path);


                    foreach ($this->childrens()->get() as $childrens => $child) {
                        $children[$childrens]['id'] = $child->id;
                        $children[$childrens]['name'] = $child->name;
                        $children[$childrens]['image'] = config('app.url') . '/storage/children/' . $child->attachmentable()->first()->path;

                        foreach ($this->attachmentable()->get() as $index => $image) {
                            $images[$index]['id'] = $image->id;
                            $images[$index]['image_path'] = asset('storage/booking_services/' . $image->path);
                        }
                    }
                }
            }

        }

        $data = [
            'activity' => [
                'id'=>$this->id,
                'attended'=>$this->attended,
                'notes'=>$this->notes,
                'master_id'=>$this->master_id,
                'services' =>$services,
                'attachmentable_services' =>$attachmentable_services,
                'child' => $children,
                'image' => $images,

            ],
        ];
        return $data;




    }

}
