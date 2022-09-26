<?php

namespace App\Repositories\Interfaces\Api\Admin;

use App\Repositories\Interfaces\IBaseRepository;

interface IAdminRepository extends IBaseRepository
{
    public function createRequest($request);
    public function notifications();
}
