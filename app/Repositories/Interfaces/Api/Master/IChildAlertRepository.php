<?php

namespace App\Repositories\Interfaces\Api\Master;

use App\Repositories\Interfaces\IBaseRepository;

interface IChildAlertRepository extends IBaseRepository
{
    public function fetchForChild($child_id);
}
