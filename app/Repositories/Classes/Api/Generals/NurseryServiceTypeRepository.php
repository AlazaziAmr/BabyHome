<?php

namespace App\Repositories\Classes\Api\Generals;

use App\Models\Api\Generals\NurseryServiceType;
use App\Repositories\Classes\BaseRepository;
use App\Repositories\Interfaces\Api\Generals\INurseryServiceTypeRepository;


class NurseryServiceTypeRepository extends BaseRepository implements INurseryServiceTypeRepository
{
    public function model()
    {
        return NurseryServiceType::class;
    }


    public function SubServices($parent_id = 0)
    {
        return $this->model->where('parent_id',$parent_id)->get();
    }
}
