<?php

namespace App\Repositories\Classes\Api\Nurseries\Profile;

use App\Models\Api\Generals\Amenity;
use App\Models\Api\Nurseries\Nursery;
use App\Models\Api\Nurseries\NurseryAmenity;
use App\Repositories\Classes\BaseRepository;
use App\Repositories\Interfaces\Api\Nurseries\Profile\INurseryAmenityRepository;
use http\Client\Curl\User;

class NurseryAmenityRepository extends BaseRepository implements INurseryAmenityRepository
{

    function model()
    {
        return NurseryAmenity::class;
    }

    public function fetchAllForCurrentUser($with = [], $columns = array('*'))
    {
        $nursery = Nursery::where('user_id', user()->id)->first();
        return $this->model->where('nursery_id',$nursery->id)->with($with)->get($columns);
//        user()->nurseries()->with($with)->get($columns);
    }

    public function fetchAll($with = [], $columns = array('*'))
    {
        $nursery = Nursery::where('user_id', user()->id)->first();
        $query = $this->model;
        $query->where('nursery_id', $nursery->id);
        if (!empty($with))
            return $query->with($with)->get($columns);
        else
            return $query->get($columns);
    }

    public function create($payload)
    {
        $nursery = Nursery::where('user_id', user()->id)->first();
        $amenity = $this->model->where(['nursery_id'=>$nursery->id, 'amenity_id'=>$payload['amenity_id']])->first();
        if ($amenity == null) {
            $amenity = $this->model->create([
                'nursery_id' => $nursery->id,
                'amenity_id' => $payload['amenity_id']
            ]);
        }
        if (!empty($payload['attachments']))
            uploadAttachment($amenity, $payload, 'attachments', 'amenities');
    }


    public function update(array $payload, $id, $attribute = "id")
    {
        $amenity = $this->model::find($id);
        $amenity->update([
//            'nursery_id' => $payload['nursery_id'],
            'amenity_id' => $payload['amenity_id']
        ]);
        if (!empty($payload['attachments']))
            uploadAttachment($amenity, $payload, 'attachments', 'amenities');
    }
}
