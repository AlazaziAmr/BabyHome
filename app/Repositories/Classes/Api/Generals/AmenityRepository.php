<?php

namespace App\Repositories\Classes\Api\Generals;

use App\Models\Api\Generals\Amenity;
use App\Repositories\Classes\BaseRepository;
use App\Repositories\Interfaces\Api\Generals\IAmenityRepository;


class AmenityRepository extends BaseRepository implements IAmenityRepository
{
    public function model()
    {
        return Amenity::class;
    }

}
