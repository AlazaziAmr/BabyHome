<?php

namespace App\Http\Resources\Api\Nurseries\Profile;

use Illuminate\Http\Resources\Json\JsonResource;

class NurseryAvailabilityResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'day' => $this->day->name,
            'from_hour' => $this->from_hour,
            'to_hour' => $this->to_hour,
        ];
    }
}
