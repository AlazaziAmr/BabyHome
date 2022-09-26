<?php

namespace App\Http\Resources\Api\Nurseries;

use Illuminate\Http\Resources\Json\JsonResource;

class BabysitterQulificationResource extends JsonResource
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
//            'description' => $this->description,
            'babysitter_id' => $this->babysitter_id,
            'qualification_id' => $this->qualification_id,
            'qualification' => $this->qualification,
        ];
    }
}
