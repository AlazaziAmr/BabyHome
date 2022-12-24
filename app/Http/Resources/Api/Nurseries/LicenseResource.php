<?php

namespace App\Http\Resources\Api\Nurseries;

use Illuminate\Http\Resources\Json\JsonResource;

class LicenseResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $images = array();
        if($this->attachmentable()) {
            foreach ($this->attachmentable()->get() as $index=>$image) {
                $images[$index]['id'] =  $image->id;
                $images[$index]['image_path'] =  asset('storage/licenses/' . $image->path);
            }
        }
        return [
            'license_no' => $this->license_no,
            'images' => $images
        ];
    }
}
