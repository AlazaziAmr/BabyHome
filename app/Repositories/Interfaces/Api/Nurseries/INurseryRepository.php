<?php

namespace App\Repositories\Interfaces\Api\Nurseries;

use App\Repositories\Interfaces\IBaseRepository;

interface INurseryRepository extends IBaseRepository
{

    public function fetchAllForCurrentUser($with = [], $columns = array('*'));

    public function profile($id);

    public function createRequest($request);

    public function nurseriesCloseToMaster($with = [], $columns = array('*'));


    public function approveJoinigRequest($id);

    public function getRegisteredChildren($request, $id);

    // Admin
    public function fetchAllForAdmin($with = [], $columns = array('*'));

    public function assignTo($request);
}
