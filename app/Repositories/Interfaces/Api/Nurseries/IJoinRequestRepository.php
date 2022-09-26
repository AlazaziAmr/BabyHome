<?php

namespace App\Repositories\Interfaces\Api\Nurseries;

use App\Repositories\Interfaces\IBaseRepository;

interface IJoinRequestRepository extends IBaseRepository
{

    public function createRequest($request);

    public function fetchCustomerRequest($id);


}
