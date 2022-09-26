<?php

namespace App\Repositories\Interfaces\Api\Admin;

use App\Repositories\Interfaces\IBaseRepository;

interface IRoleRepository extends IBaseRepository
{
    public function fetchPermissions();
    public function createRequest($request);
    public function updateRequest($request, $role);
}
