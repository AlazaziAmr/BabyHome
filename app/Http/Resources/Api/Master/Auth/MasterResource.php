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
                'email' => $this->email,
                'email_verified' => $this->email_verified_at != null ? 1 : 0,
                'phone' => $this->phone,
                'address' => $this->address,
                'latitude' => $this->latitude,
                'longitude' => $this->longitude,
                'nationality' => $this->nationality->name,
            ];
        }else{
            return [
                'id' => $this->id,
                'name' => $this->name,
                'email' => $this->email,
                'phone' => $this->phone,
                'address' => $this->address,
                'latitude' => $this->latitude,
                'longitude' => $this->longitude,
                'nationality' => '',
            ];
        }

    }
}
