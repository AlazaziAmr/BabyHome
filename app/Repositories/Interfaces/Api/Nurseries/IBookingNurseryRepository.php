<?php

namespace App\Repositories\Interfaces\Api\Nurseries;

use App\Repositories\Interfaces\IBaseRepository;
use Illuminate\Http\Request;

interface IBookingNurseryRepository extends IBaseRepository
{
    public function rejected(Request $request);
    public function confirmed(Request $request);
    public function showBookingDetails($id);
    public function confirmedShow();
    public function rejectBooking();
    public function showBooking();
    public function showChildrenBooking();
    public function onlineStatus(Request $request);


}
