<?php

namespace App\Http\Resources\Api\Nurseries;

use Illuminate\Http\Resources\Json\JsonResource;

class ActivityChildResource extends JsonResource
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
        if($this['attachmentable']->attachmentable()) {
                foreach ($this['attachmentable']->attachmentable()->get() as $index=>$image) {
                    $images[$index]['id'] =  $image->id;
                    $images[$index]['image_path'] =  asset('storage/children/' . $image->path);
                }
            }
        $data = [
            'booking' => [
            'id' => $this->id,
            'child_id' => $this->name,
            'confirmDates' => $this->gender_id,
            'name' => $this->date_of_birth,
            'dateOfBirth' => $this->description,
            'description' => $this->booking->children->description,
            'gender' => $this->booking->children->gender_id,
                'image' => $images,
            ],
        ];



        return $data;
    }
}
