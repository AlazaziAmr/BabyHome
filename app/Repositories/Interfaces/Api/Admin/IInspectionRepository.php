<?php

namespace App\Repositories\Interfaces\Api\Admin;

use App\Repositories\Interfaces\IBaseRepository;

interface IInspectionRepository extends IBaseRepository
{
    public function fetchAllForAuthAdmin();

    public function submitResult($result);

    public function getResult($request);
}
