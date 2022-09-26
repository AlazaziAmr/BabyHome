<?php

namespace App\Repositories\Classes\Api\Generals;

use App\Models\Api\Generals\Utility;
use App\Repositories\Classes\BaseRepository;
use App\Repositories\Interfaces\Api\Generals\IUtilityRepository;


class UtilityRepository extends BaseRepository implements IUtilityRepository
{
    public function model()
    {
        return Utility::class;
    }


}
