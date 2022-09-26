<?php

namespace App\Http\Resources\Api\Master\Children;

use App\Http\Resources\Api\Generals\NameResource;
use Illuminate\Http\Resources\Json\JsonResource;

class ChildResource extends JsonResource
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
            'master' => $this->master['name'],
            'created_at' => $this->created_at,
            'age' => $this->age,
            'gender' => $this->gender['name'],
            'date_of_birth' => $this->date_of_birth,
            'description' => $this->description,
            'languages' => NameResource::collection($this->languages->makeHidden('pivot')),
            'neresry' => "null for now",
            'phones' => $this->phones,
            'address' => $this->master['address'],
            'image' => $this->mainAttachment,
            'siblings' => ChildCardResource::collection($this->master->children),
        ];
    }
}
