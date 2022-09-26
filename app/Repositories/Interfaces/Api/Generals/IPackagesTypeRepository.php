<?php

namespace App\Repositories\Interfaces\Api\Generals;

use App\Repositories\Interfaces\IBaseRepository;

interface IPackagesTypeRepository extends IBaseRepository
{
    public function fetchAllActive();
}
