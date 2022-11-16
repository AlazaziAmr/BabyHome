<?php

namespace App\Http\Resources\Api\Master\Auth;

use Illuminate\Http\Resources\Json\JsonResource;

class MasterResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        if(isset($this->nationality)){
            return [
                'id' => $this->id,
                'name' => $this->name,
                'first_name' => $this->first_name,
                'last_name' => $this->last_name,
                'gender' => $this->gender,
                'card_expiration_date' => $this->card_expiration_date,
                'date_of_birth' => $this->date_of_birth,
                'email' => $this->email,
                'email_verified' => $this->email_verified_at != null ? 1 : 0,
                'phone' => $this->phone,
                'phone_verified' => $this->is_verified,
                'address' => $this->address,
                'latitude' => $this->latitude,
                'longitude' => $this->longitude,
                'nationality' => $this->nationality->name,
            ];
        }else{
            return [
                'id' => $this->id,
                'name' => $this->name,
                'first_name' => $this->first_name,
                'last_name' => $this->last_name,
                'gender' => $this->gender,
                'card_expiration_date' => $this->card_expiration_date,
                'date_of_birth' => $this->date_of_birth,
                'email' => $this->email,
                'email_verified' => $this->email_verified_at != null ? 1 : 0,
                'phone' => $this->phone,
                'phone_verified' => $this->is_verified,
                'address' => $this->address,
                'latitude' => $this->latitude,
                'longitude' => $this->longitude,
                'nationality' => '',
            ];
        }

    }
}
