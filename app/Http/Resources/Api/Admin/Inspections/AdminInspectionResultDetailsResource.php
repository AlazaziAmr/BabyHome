<?php

namespace App\Http\Resources\Api\Admin\Inspections;

use Illuminate\Http\Resources\Json\JsonResource;

class AdminInspectionResultDetailsResource extends JsonResource
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
            'criteria' =>  $this->criteria,
            'rating' =>  $this->rating,
            'matching' => $this->matching,
            'recommendation' =>  $this->recommendation,
            'comment' => $this->comment,
        ];
    }
}
