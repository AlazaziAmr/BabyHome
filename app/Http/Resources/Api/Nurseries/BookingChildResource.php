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
       /* return [

            'image' => $this->booking->children->name,
        ];*/
        $images = array();
        if($this->booking['children']->attachmentable()) {
                foreach ($this->booking['children']->attachmentable()->get() as $index=>$image) {
                    $images[$index]['id'] =  $image->id;
                    $images[$index]['image_path'] =  asset('storage/children/' . $image->path);
                }
            }
        $data = [
            'booking' => [
            'id' => $this->id,
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
