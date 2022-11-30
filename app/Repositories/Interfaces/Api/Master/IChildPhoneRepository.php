<?php

namespace App\Repositories\Interfaces\Api\Master;

use App\Repositories\Interfaces\IBaseRepository;

interface IChildPhoneRepository extends IBaseRepository
{
    public function fetchForChild($child_id,$with = []);
    public function createRequest($payload);
}
