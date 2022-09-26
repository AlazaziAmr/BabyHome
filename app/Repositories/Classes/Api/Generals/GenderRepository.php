<?php

namespace App\Repositories\Classes\Api\Generals;

use App\Models\Api\Generals\Gender;
use App\Repositories\Classes\BaseRepository;
use App\Repositories\Interfaces\Api\Generals\IGenderRepository;


class GenderRepository extends BaseRepository implements IGenderRepository
{
    public function model()
    {
        return Gender::class;
    }


}
