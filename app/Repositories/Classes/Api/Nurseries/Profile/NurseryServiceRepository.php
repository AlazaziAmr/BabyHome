<?php

namespace App\Repositories\Classes\Api\Nurseries\Profile;

use App\Models\Api\Generals\Attachment;
use App\Models\Api\Generals\Service;
use App\Models\Api\Nurseries\Nursery;
use App\Models\Api\Nurseries\NurseryService;
use App\Repositories\Classes\BaseRepository;
use App\Repositories\Interfaces\Api\Nurseries\Profile\INurseryServiceRepository;

class NurseryServiceRepository extends BaseRepository implements INurseryServiceRepository
{

    function model()
    {
        return NurseryService::class;
    }

    public function nursery_services($with = [])
    {
        $nursery = Nursery::where('user_id',user()->id)->first();
        $query = $this->model->where('nursery_id',$nursery->id)->with($with)->get();
        return $query;
    }

    public function create($payload)
    {
        $nursery = Nursery::where('user_id',user()->id)->first();

        $service = Service::create([
            'name'  => $payload['name'],
            'description'  => $payload['description'],
            'price'  => $payload['price'],
            'is_paid'  => $payload['is_paid'],
            'type_id'  => $payload['type_id'],
            'is_active'  => $payload['is_active'],
            'user_id' => user()->id,
            'sub_category_id'   =>$payload['sub_category_id'],
        ]);
        $this->model->create([
            'nursery_id' => $nursery->id,
            'service_id' => $service->id,
        ]);
        if (!empty($payload['attachments']))
            uploadAttachment($service, $payload, 'attachments', 'services');
    }


    public function update(array $payload, $id, $attribute = "id")
    {
        $service = $this->model->where('service_id',$id)->first();
        if($service->user_id == user()->id){
            $service->update([
                'name'  => $payload['name'],
                'description'  => $payload['description'],
                'price'  => $payload['price'],
                'is_paid'  => $payload['is_paid'],
                'type_id'  => $payload['type_id'],
                'is_active'  => $payload['is_active'],
                'sub_category_id'   =>$payload['sub_category_id'],
            ]);
            if (!empty($payload['attachments']))
                uploadAttachment($service, $payload, 'attachments', 'services');
        }
    }

    public function delete($id)
    {
        $service = $this->model->where('service_id',$id)->first();
        if($service->user_id == user()->id){
            $service->delete();
        }
    }

    public function delete_attachment($id)
    {
        $a = Attachment::find($id);
        $a ? $a->delete() : '';
        return;
    }
}
