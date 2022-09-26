<?php

namespace App\Repositories\Classes\Api\Generals;

use App\Models\Api\Generals\City;
use App\Repositories\Classes\BaseRepository;
use App\Repositories\Interfaces\Api\Generals\ICityRepository;


class CityRepository extends BaseRepository implements ICityRepository
{
    public function model()
    {
        return City::class;
    }


}
