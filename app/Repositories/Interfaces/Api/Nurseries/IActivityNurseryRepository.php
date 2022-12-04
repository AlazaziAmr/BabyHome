<?php

namespace App\Repositories\Interfaces\Api\Nurseries;

use App\Repositories\Interfaces\IBaseRepository;
use Illuminate\Http\Request;

interface IActivityNurseryRepository extends IBaseRepository
{

    public function showActivity();

    public function addActivity($request);

}
