<?php

namespace App\Repositories\Classes\Api\Master;

use App\Models\Api\Master\ChildAlert;
use App\Models\Api\Master\ChildAllergy;
use App\Repositories\Classes\BaseRepository;
use App\Repositories\Interfaces\Api\Master\IChildAllergyRepository;

class ChildAlertRepository extends BaseRepository implements IChildAllergyRepository
{

    function model()
    {
        return ChildAlert::class;
    }
    public function fetchForChild($child_id){
        return $this->model->where('child_id',$child_id)->get();
    }
}
