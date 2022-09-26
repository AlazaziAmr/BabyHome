<?php

namespace App\Http\Resources\Api\Admin\Nurseries;

use Illuminate\Http\Resources\Json\JsonResource;

class ServiceResource extends JsonResource
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
            "id" => $this->id,
            "description" => $this->description,
            "price" => $this->price,
            "is_paid" => $this->is_paid ? trans('responses.paid') : trans('responses.not_paid'),
            "type" => $this->type['name'],
            'attachments' => getAllAttachments($this->attachmentable, 'services'),

        ];
    }
}
