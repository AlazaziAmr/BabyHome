<?php

namespace App\Repositories\Interfaces\Api\Nurseries;

use App\Repositories\Interfaces\IBaseRepository;
use Illuminate\Http\Request;

interface IActivityNurseryRepository extends IBaseRepository
{

    public function showActivityToday();

    public function addActivity($request);
    public function showCompleteActivityBooking();
    public function showDetailsActivityComplate(Request $request);

}
