<?php

namespace App\Repositories\Classes\Api\Nurseries\Profile;

use App\Models\Api\Nurseries\BabysitterInfo;
use App\Repositories\Classes\BaseRepository;
use App\Repositories\Interfaces\Api\Nurseries\Profile\IBabySitterRepository;

class BabySitterRepository extends BaseRepository implements IBabySitterRepository
{
    function model()
    {
        return BabysitterInfo::class;
    }
}
