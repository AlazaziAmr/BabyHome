<?php

namespace App\Http\Resources\Api\Nurseries\Profile;

use Illuminate\Http\Resources\Json\JsonResource;

class BabysitterQualificationResource extends JsonResource
{

    public function toArray($request)
    {
        $images = array();
        foreach ($this->attachmentable as $item){
            $images[] = asset('storage/baby-sitters/' . $item->path);
        }
        return [
            'id' => $this->id,
            'description' => $this->description,
            'babysitter_id', $this->babysitter_id,
            'images' => $images
        ];
    }
}
