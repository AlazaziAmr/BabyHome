<?php

namespace App\Repositories\Interfaces\Api\Generals;

use App\Repositories\Interfaces\IBaseRepository;

interface IServiceRepository extends IBaseRepository
{
    public function fetchAllFromAdmin($with = [], $columns = array('*'));
    public function createRequest($request);
}
