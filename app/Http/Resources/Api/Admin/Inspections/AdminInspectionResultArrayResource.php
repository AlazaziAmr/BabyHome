<?php

namespace App\Http\Resources\Api\Admin\Inspections;

use Illuminate\Http\Resources\Json\JsonResource;

class AdminInspectionResultArrayResource extends JsonResource
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
            'inspector' => [
                'name' => $this->inspector['name'],
                'latitude' => $this->result['latitude'],
                'longitude' => $this->result['longitude'],
                'from' => $this->from,
                'to' => $this->to,
            ],
            'result' => AdminInspectionResultDetailsResource::collection($this->result->details)->resolve(),
            'attachments' => getAllAttachments($this->result->attachmentable, 'inspections-results'),
        ];
    }
}
