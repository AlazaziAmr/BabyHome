<?php

namespace App\Repositories\Classes\Api\Generals;

use App\Models\Api\Generals\Neighborhood;
use App\Repositories\Classes\BaseRepository;
use App\Repositories\Interfaces\Api\Generals\INeighborhoodRepository;


class NeighborhoodRepository extends BaseRepository implements INeighborhoodRepository
{
    public function model()
    {
        return Neighborhood::class;
    }

    public function cityNeighbirhoods($id)
    {
        return $this->model->with('city')->where('city_id',$id)->get()->take(100);
    }
}
