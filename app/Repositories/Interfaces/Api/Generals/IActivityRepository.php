<?php

namespace App\Repositories\Interfaces\Api\Generals;

use App\Repositories\Interfaces\IBaseRepository;

interface IActivityRepository extends IBaseRepository
{
    public function fetchAllFromAdmin($with = [], $columns = array('*'));
    public function createRequest($request);

    public function index();
}
