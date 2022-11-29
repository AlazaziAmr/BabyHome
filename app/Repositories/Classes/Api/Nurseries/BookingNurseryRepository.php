<?php

namespace App\Repositories\Classes\Api\Nurseries;

use App\Models\Api\Master\Booking\RejectResReasons;
use App\Models\Api\Master\BookingServices\Booking;
use App\Models\Api\Master\BookingServices\BookingLog;
use App\Models\Api\Master\BookingServices\BookingService;
use App\Models\Api\Master\BookingServices\ConfirmedBooking;
use App\Models\Api\Nurseries\JoinRequest\JoinRequest;
use App\Models\Api\Nurseries\Nursery;
use App\Repositories\Classes\BaseRepository;
use App\Repositories\Interfaces\Api\Nurseries\IBookingNurseryRepository;
use Illuminate\Http\Request;


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

    public function Booking()
    {
        $user_id = auth('api')->user()->id;
        $nursery_id=Nursery::where('user_id',$user_id)->pluck('id');
        $nurseryBooking=Booking::whereIn("nursery_id",$nursery_id)->where('status_id', 1)->with([
            'masters:id,uid,first_name',
            'children:id,name,date_of_birth',
            'BookingStatus:id,name',
        ])->get();

        return $nurseryBooking;

    }
    public function showBooking()
    {
        $user_id = auth('api')->user()->id;
        $nursery_id=Nursery::where('user_id',$user_id)->pluck('id');
        $nurseryBooking=Booking::whereIn("nursery_id",$nursery_id)->where('status_id', 1)->with([
            'masters:id,uid,first_name',
            'children:id,name,date_of_birth',
            'BookingStatus:id,name',
            'nurseries',
        ])->get();

        return $nurseryBooking;

    }


    public function showBookingDetails($id)
    {
        $nurseryBooking=Booking::where('id',$id)->with([
            'masters.children:id,name,date_of_birth',
            'BookingStatus:id,name',
            'children.sicknesses',
            'children.languages',
            'children.allergies',
        ])->get();

        return $nurseryBooking;

    }


    public function bookingLog($request,$status,$user_type)
    {
        $babySitter = BookingLog::create([
            'user_id' => $request->nursery_id,
            'user_type' => $user_type,
            'booking_id' => $request->booking_id,
            'status_id' => $status,

        ]);
    }

    public function rejected(Request $request)
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
        $user_type=2;
        $this->bookingLog($request,$status,$user_type);

         Booking::where('id', $request->booking_id)->update([
            'status_id' => $status,
        ]);

         BookingService::where('booking_id', $request->booking_id)->where('child_id',$request->child_id)
            ->update([
            'status' => $status,
        ]);

    }
    public function confirmed(Request $request)
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
         * child_id
         * */

        $price_per_hour=Nursery::select('price')->where('id',$request->nursery_id)->first();
        $total_services_price=BookingService::where('booking_id',$request->booking_id)
            ->where('child_id',$request->child_id) ->where('nursery_id',$request->nursery_id)->sum('service_price');
        $total_payment=(($price_per_hour->price)*$request->total_hours)+$total_services_price;
        $status="2";
       $confirm_date =now()->format('Y-m-d');
        $RejectResReasons = ConfirmedBooking::create([
            'nursery_id' => $request->nursery_id,
            'booking_id' => $request->booking_id,
            'payment_method_id' => $request->payment_method_id,
            'confirm_date' => $confirm_date,
            'total_payment' => $total_payment,
            'price_per_hour' => $price_per_hour->price,
            'total_services_price' => $total_services_price,
            'created_by' => $request->created_by,
            'status' => "2",
        ]);
          BookingService::where('booking_id', $request->booking_id)->where('child_id',$request->child_id)->update([
            'status' => $status,
        ]);

        $user_type=2;
        $this->bookingLog($request,$status,$user_type);
        $request = Booking::where('id', $request->booking_id)->update([
            'status_id' => $status,
        ]);
    }


    public function confirmedShow()
    {
        $user_id = auth('api')->user()->id;
        $nursery_id=Nursery::where('user_id',$user_id)->pluck('id');

        $ConfirmedBooking=ConfirmedBooking::whereIn('nursery_id',$nursery_id)->with([
            "Booking.children",
            "PaymentMethod",
            'Booking.children.sicknesses',
            'Booking.children.languages',
            'Booking.children.allergies',


        ])->get();

        return $ConfirmedBooking;

    }

}
