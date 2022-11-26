<?php

namespace App\Repositories\Classes\Api\Nurseries;

use App\Models\Api\Master\Booking\RejectResReasons;
use App\Models\Api\Master\BookingServices\Booking;
use App\Models\Api\Master\BookingServices\BookingLog;
use App\Models\Api\Master\BookingServices\ConfirmedBooking;
use App\Models\Api\Nurseries\JoinRequest\JoinRequest;
use App\Models\Api\Nurseries\Nursery;
use App\Repositories\Classes\BaseRepository;
use App\Repositories\Interfaces\Api\Nurseries\IBookingNurseryRepository;


class BookingNurseryRepository extends BaseRepository implements IBookingNurseryRepository
{
    public function model()
    {
        return JoinRequest::class;
    }

    public function Nursery()
    {
        return Nursery::class;
    }


    public function showBooking()
    {
        $user_id = auth('api')->user()->id;
        $nurseryBooking=Nursery::select('id','user_id')->where("user_id",$user_id)->with([
            'booking.Masters:id,uid,name',
            'booking.children:id,name',
            'booking.BookingStatus:id,name',
            'booking' => function ($query1) {
                $query1
                    ->where('status_id', 1);
            }
        ])->get();

        return $nurseryBooking;

    }

    public function bookingLog($request,$status)
    {
        $babySitter = BookingLog::create([
            'user_id' => $request->nursery_id,
            'user_type' => 1,
            'booking_id' => $request->booking_id,
            'status_id' => $status,

        ]);
    }

    public function rejected($request)
    {

        /*booking_id
         * reason
         * nursery_id
         * */
        $RejectResReasons = RejectResReasons::create([
            'booking_id' => $request->booking_id,
            'reason' => $request->reason,
        ]);
        $status="3";
        $this->bookingLog($request,$status);
        $request = Booking::where('id', $request->booking_id)->first();
        $request->update([
            'status_id' => 3,
        ]);
    }
    public function confirmed($request)
    {

        /*booking_id
         * payment_method_id
         * nursery_id
         * confirm_date
         * total_payment
         * price_per_hour
         * total_services_price
         * created_by
         * status
         * */
        $RejectResReasons = ConfirmedBooking::create([
            'nursery_id' => $request->nursery_id,
            'booking_id' => $request->booking_id,
            'payment_method_id' => $request->payment_method_id,
            'confirm_date' => $request->confirm_date,
            'total_payment' => $request->total_payment,
            'price_per_hour' => $request->price_per_hour,
            'total_services_price' => $request->total_services_price,
            'created_by' => $request->created_by,
            'status' => $request->status,
        ]);
        $status="2";
        $this->bookingLog($request,$status);
        $request = Booking::where('id', $request->booking_id)->first();
        $request->update([
            'status_id' => 3,
        ]);
    }

}
