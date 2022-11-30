<?php

namespace App\Repositories\Classes\Api\Master;

use App\Models\Api\Master\Child;
use App\Models\Api\Master\ChildSickness;
use App\Models\Api\Master\Phone;
use App\Repositories\Classes\BaseRepository;
use App\Repositories\Interfaces\Api\Master\IChildPhoneRepository;
use App\Repositories\Interfaces\Api\Master\IChildSicknessRepository;

class ChildPhoneRepository extends BaseRepository implements  IChildPhoneRepository
{

    function model()
    {
        return Phone::class;
    }

    public function fetchForChild($child_id,$with = []){
        return $this->model->where('child_id',$child_id)->with($with)->get();
    }

    public function createRequest($payload)
    {
        $child = Child::findOrFail($payload['child_id']);
        foreach ($payload['phones'] as $phone){
            $this->model->create([
                'child_id' => $payload['child_id'],
                'phone' => $phone['value'],
                'name' => $phone['name'],
                'relation_type' => $phone['relation_id'],
            ]);
        }
    }

    public function update(array $payload, $id, $attribute = "id")
    {
        $phone = $this->model->findOrFail($id);
        $phone->update([
            'phone' => $payload['phones'][0]['value'],
            'name' => $payload['phones'][0]['name'],
            'relation_type' => $payload['phones'][0]['relation_id'],
        ]);
    }
}
