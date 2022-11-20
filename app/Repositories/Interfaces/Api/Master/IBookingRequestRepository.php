<?php

namespace App\Repositories\Interfaces\Api\Master;

use App\Repositories\Interfaces\IBaseRepository;
use Illuminate\Http\Request;

interface IBookingRequestRepository extends IBaseRepository
{

    public function createRequest($request);

    public function fetchCustomerRequest($id);
    public function filterMaster(Request $request);
    public function booking(Request $request);
    public function nurseriesDetails($id);
    public function showNurseries();





}
