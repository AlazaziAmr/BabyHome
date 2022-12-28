<?php

namespace App\Http\Resources\Api\Nurseries;

use Illuminate\Http\Resources\Json\JsonResource;

class BookingChildResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {


        $images = array();
        $child = array();

        if($this->booking()) {

        foreach($this->booking()->get() as  $kids){
            foreach($kids->children()->get() as $kid) {
                $child['child_id']=$kid->id;
                $child['name']=$kid->name;
                $child['dateOfBirth']=$kid->date_of_birth;
                $child['description']=$kid->description;
                $child['gender']=$kid->gender_id;
                $images['image'] = env('APP_URL').'/storage/children/'.$kid->attachmentable()->first()->path;



            }

            }
            }
   /*     if($this->booking['children']->attachmentable()) {
                foreach ($this->booking['children']->attachmentable()->get() as $index=>$image) {
                    $images[$index]['id'] =  $image->id;
                    $images[$index]['image_path'] =  asset('storage/children/' . $image->path);
                }
            }*/
        $data = [
            'booking' => [
            'id' => $this->id,
/*            'child_id' => $this->booking->children->id,*/
            'confirmDates' => $this->confirm_date,
/*            'name' => $this->booking->children->name,*/
/*            'dateOfBirth' => $this->booking->children->date_of_birth,*/
/*            'description' => $this->booking->children->description,*/
/*            'gender' => $this->booking->children->gender_id,*/
                'child' => $child,
                'image' => $images,
            ],
        ];



        return $data;
    }
}
