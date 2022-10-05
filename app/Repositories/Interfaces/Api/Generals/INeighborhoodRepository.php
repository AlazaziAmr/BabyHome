<?php

namespace App\Repositories\Interfaces\Api\Generals;

use App\Repositories\Interfaces\IBaseRepository;

interface INeighborhoodRepository extends IBaseRepository
{
    public function cityNeighbirhoods($id);
}
