<?php

namespace App\Http\Resources\Api\Nurseries\Profile;

use Illuminate\Http\Resources\Json\JsonResource;

class NurseryServiceResource extends JsonResource
{

    public function toArray($request)
    {
        $data = [
            'id' => $this->id,
            'service_id' => $this->service_id,
        ];

        if ($this->service) {
            $data += [
                'name' => $this->service->name,
                'description' => $this->service->description,
                'price' => $this->service->price,
                'is_paid'  => $this->service->is_paid,
                'is_active'  => $this->service->is_active,
                'type_id'  => $this->service->type_id,
                'type_name'  => ($this->service->type) ? $this->service->type->name : '',
                'sub_category_id'  => $this->service->sub_category_id,
                'sub_category_name'  => ($this->service->sub_type) ? $this->service->sub_type->name : '',
            ];
            $images = array();
            if($this->service){
                foreach ($this->service->attachmentable as $index=>$image) {
                    $images[$index]['id'] =  $image->id;
                    $images[$index]['image_path'] =  asset('storage/services/' . $image->path);
                }
            }
            $data['images']  = $images;
        }else{
            $data += [
                'name' => '',
                'description' => '',
                'price' => '',
                'is_paid' => '',
                'type_id' => '',
                'is_active' => '',
                'images' => '',
            ];
        }
        return $data;
    }
}
