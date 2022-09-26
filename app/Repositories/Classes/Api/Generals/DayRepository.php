<?php

namespace App\Repositories\Classes\Api\Generals;

use App\Models\Api\Generals\Day;
use App\Repositories\Classes\BaseRepository;
use App\Repositories\Interfaces\Api\Generals\IDayRepository;


class DayRepository extends BaseRepository implements IDayRepository
{
    public function model()
    {
        return Day::class;
    }
}
