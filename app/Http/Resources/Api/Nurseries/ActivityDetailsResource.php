<?php

namespace App\Http\Resources\Api\Nurseries;

use Illuminate\Http\Resources\Json\JsonResource;

class ActivityDetailsResource extends JsonResource
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
        if($this['children']->attachmentable()) {
                foreach ($this['children']->attachmentable()->get() as $index=>$image) {
                    $images[$index]['id'] =  $image->id;
                    $images[$index]['image_path'] =  asset('storage/children/' . $image->path);
                }
            }
        $data = [
            'booking' => [
            'id' => $this->id,
            'nursery_id' => $this->nursery_id,
            'booking_id' => $this->booking_id,
            'service_id' => $this->service_id,
            'master_id' => $this->master_id,
            'notes' => $this->notes,
            'child_id' => $this->children->id,
            'name' => $this->children->name,
            'dateOfBirth' => $this->date_of_birth,
            'description' => $this->children->description,
            'gender' => $this->gender_id,
                'image' => $images,
            ],
        ];



        return $data;
    }
}
