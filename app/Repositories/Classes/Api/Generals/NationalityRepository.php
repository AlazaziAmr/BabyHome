<?php

namespace App\Repositories\Classes\Api\Generals;

use App\Models\Api\Generals\Nationality;
use App\Repositories\Classes\BaseRepository;
use App\Repositories\Interfaces\Api\Generals\INationalityRepository;


class NationalityRepository extends BaseRepository implements INationalityRepository
{
    public function model()
    {
        return Nationality::class;
    }


}
