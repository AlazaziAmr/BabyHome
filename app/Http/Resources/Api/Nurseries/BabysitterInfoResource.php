<?php

namespace App\Http\Resources\Api\Nurseries;

use Illuminate\Http\Resources\Json\JsonResource;

class BabysitterInfoResource extends JsonResource
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
            'years_of_experince' => $this->years_of_experince,
            'date_of_birth' => $this->date_of_birth,
            'free_of_disease' => $this->free_of_disease,
            'national_id' => $this->national_id,
            'nationalityData' => $this->nationalitydata,
            'languages' => $this->languages,
            'image' => $this->getMainAttachmentAttribute,
        ];
    }
}
