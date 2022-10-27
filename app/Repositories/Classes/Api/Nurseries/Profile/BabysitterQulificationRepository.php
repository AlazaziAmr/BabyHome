<?php

namespace App\Repositories\Classes\Api\Nurseries\Profile;

use App\Models\Api\Nurseries\BabysitterQualification;
use App\Repositories\Classes\BaseRepository;
use App\Repositories\Interfaces\Api\Nurseries\Profile\IBabysitterQulificationRepository;

class BabysitterQulificationRepository extends BaseRepository implements IBabysitterQulificationRepository
{

    function model()
    {
        return BabysitterQualification::class;
    }

    public function babySitterQualifications($id){
        return $this->model->where('babysitter_id',$id)
            ->with('qualification')->get();
    }

}
