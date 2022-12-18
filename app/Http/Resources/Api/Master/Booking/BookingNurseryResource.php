<?php

namespace App\Http\Resources\Api\Master\Booking;

use Illuminate\Http\Resources\Json\JsonResource;

class BookingNurseryResource extends JsonResource
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
        if($this->children->attachmentable()) {
                foreach ($this->children->attachmentable()->get() as $index=>$image) {
                    $images[$index]['id'] =  $image->id;
                    $images[$index]['image_path'] =  asset('storage/children/' . $image->path);
                }
            }
        $data = [
            'booking' => [
                'id' => $this->nursery_id,
                'status_id' => $this->status_id,
                'BookingStatus' => $this->BookingStatus->name,
                'total_hours' => $this->total_hours,
                'child_id' => $this->children->id,
                'child_name' => $this->children->name,
                'date_of_birth' => $this->children->date_of_birth,
                'booking_id' => $this->id,
                'nursery_id' => $this->nursery_id,
                'master_id' => $this->master_id,
                'master_uid' => $this->masters->uid,
                'master_first_name' => $this->masters->master_first_name,
                'booking_date' => $this->booking_date,
                'image' => $images,
                /*                'child_id' => $this->booking->children->id,*/
             /*   'confirmDates' => $this->booking_date,
            'dateOfBirth' => $this->booking->children->date_of_birth,
            'description' => $this->booking->children->description,
            'gender' => $this->booking->children->gender_id,
                'image' => $images,*/
            ],
        ];



        return $data;
    }
}
