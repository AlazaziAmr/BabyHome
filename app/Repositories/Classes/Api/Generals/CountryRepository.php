<?php

namespace App\Repositories\Classes\Api\Generals;

use App\Models\Api\Generals\Country;
use App\Repositories\Classes\BaseRepository;
use App\Repositories\Interfaces\Api\Generals\ICountryRepository;


class CountryRepository extends BaseRepository implements ICountryRepository
{
    public function model()
    {
        return Country::class;
    }


}
