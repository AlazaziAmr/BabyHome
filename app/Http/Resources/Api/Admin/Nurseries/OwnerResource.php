<?php

namespace App\Http\Resources\Api\Admin\Nurseries;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Api\Generals\LanguageResource;
use App\Http\Resources\Api\Generals\AdminQualificationResource;

class OwnerResource extends JsonResource
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
            'name' => $this->name,
            'phone' => $this->phone,
            'email' => $this->email,
            'years_of_experince' => $this->info->years_of_experince,
            'date_of_birth' => $this->info->date_of_birth,
            'main_attachment' => $this->info->mainAttachment,
            'skills' => $this->info->skills,
            'languages' => LanguageResource::collection($this->info->languages),
            'qualifications' => AdminQualificationResource::collection($this->info->qualifications),
            'attachments' => getAllAttachments($this->info->attachmentable, 'baby-sitters'),
        ];
    }
}
