<?php

namespace App\Repositories\Interfaces\Api\Generals;

use App\Repositories\Interfaces\IBaseRepository;

interface INurseryServiceTypeRepository extends IBaseRepository
{
    public function subServices($parent_id = 0);
    public function parentServices();

}
