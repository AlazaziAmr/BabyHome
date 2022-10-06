<?php

namespace App\Repositories\Classes\Api\Master;

use App\Models\Api\Master\ChildSickness;
use App\Repositories\Classes\BaseRepository;
use App\Repositories\Interfaces\Api\Master\IChildSicknessRepository;

class ChildSicknessRepository extends BaseRepository implements  IChildSicknessRepository
{

    function model()
    {
        return ChildSickness::class;
    }

    public function fetchForChild($child_id){
        return $this->model->where('child_id',$child_id)->get();
    }
}
