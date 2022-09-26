<?php

namespace App\Http\Resources\Api\Master\Children;

use Illuminate\Http\Resources\Json\JsonResource;

class ChildCardResource extends JsonResource
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
            'name' => $this->name,
            'date_of_birth' => $this->date_of_birth,
            'age' => $this->age,
            'gender' => $this->gender['name'],
            'image' => $this->mainAttachment,
        ];
    }
}
