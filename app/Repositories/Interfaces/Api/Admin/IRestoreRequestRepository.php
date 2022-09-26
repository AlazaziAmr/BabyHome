<?php

namespace App\Repositories\Interfaces\Api\Admin;

use App\Repositories\Interfaces\IBaseRepository;

interface IRestoreRequestRepository extends IBaseRepository
{
    public function fetchUsers();
    public function restoreUser($id);
}
