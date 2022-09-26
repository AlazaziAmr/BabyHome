<?php

namespace App\Repositories\Interfaces\Api\Master;

use App\Repositories\Interfaces\IBaseRepository;

interface IChildrenRepository extends IBaseRepository
{
    public function fetchAllForCurrentUser();


    public function createRequest($payload);
}
