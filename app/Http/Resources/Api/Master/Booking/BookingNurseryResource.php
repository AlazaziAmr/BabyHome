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
        $child = array();
        if($this->children()) {
                foreach ($this->children()->get() as $kid) {
                    $child['child_id']=$kid->id;
                    $child['child_name']=$kid->name;
                    $child['date_of_birth']=$kid->date_of_birth;
                    $images['image'] = env('APP_URL').'/storage/children/'.$kid->attachmentable()->first()->path;
  }
            }
        $data = [
            'booking' => [
                'id' => $this->nursery_id,
                'status_id' => $this->status_id,
                'BookingStatus' => $this->BookingStatus->name,
                'total_hours' => $this->total_hours,
                'booking_id' => $this->id,
                'nursery_id' => $this->nursery_id,
                'master_id' => $this->master_id,
                'master_uid' => $this->masters->uid,
                'master_first_name' => $this->masters->master_first_name,
                'booking_date' => $this->booking_date,
                'child' => $child,
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
