<?php

namespace App\Repositories\Classes\Api\Nurseries\Profile;

use App\Models\Api\Nurseries\BabysitterQualification;
use App\Repositories\Classes\BaseRepository;
use App\Repositories\Interfaces\Api\Nurseries\Profile\IBabysitterQualificationRepository;

class BabysitterQualificationRepository extends BaseRepository implements IBabysitterQualificationRepository
{

    function model()
    {
        return BabysitterQualification::class;
    }
}
