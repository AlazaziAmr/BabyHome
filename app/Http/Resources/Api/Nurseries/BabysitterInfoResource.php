<?php

namespace App\Http\Resources\Api\Nurseries;

use App\Http\Resources\Api\Generals\LanguageResource;
use App\Http\Resources\Api\Generals\NameResource;
use App\Http\Resources\Api\Generals\NationalityResource;
use Illuminate\Http\Resources\Json\JsonResource;

class BabysitterInfoResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'years_of_experince' => $this->years_of_experince,
            'date_of_birth' => $this->date_of_birth,
            'free_of_disease' => $this->free_of_disease,
            'national_id' => $this->national_id,
            'nationalityData' => new NationalityResource($this->nationalitydata),
            'languages' => LanguageResource::collection($this->languages),
            'image' => $this->getImages(),
        ];
    }
}
