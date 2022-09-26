<?php

namespace App\Http\Resources\Api\Generals;

use Illuminate\Http\Resources\Json\JsonResource;

class AdminQualificationResource extends JsonResource
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
            'description' => $this->description,
            'name' => $this->qualification->name,
        ];
    }
}
