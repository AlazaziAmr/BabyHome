<?php

namespace App\Repositories\Interfaces\Api\Master;

use App\Repositories\Interfaces\IBaseRepository;

interface IChildSicknessRepository extends IBaseRepository
{
    public function fetchForChild($child_id);
}
