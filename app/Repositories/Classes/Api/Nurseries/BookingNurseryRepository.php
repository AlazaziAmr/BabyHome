<?php

namespace App\Repositories\Classes\Api\Nurseries;

use App\Http\Resources\Api\Nurseries\BookingChildResource;
use App\Models\Api\Master\Booking\RejectResReasons;
use App\Models\Api\Master\BookingServices\Booking;
use App\Models\Api\Master\BookingServices\BookingLog;
use App\Models\Api\Master\BookingServices\BookingService;
use App\Models\Api\Master\BookingServices\ConfirmedBooking;
use App\Models\Api\Master\Child;
use App\Models\Api\Nurseries\JoinRequest\JoinRequest;
use App\Models\Api\Nurseries\Nursery;
use App\Repositories\Classes\BaseRepository;
use App\Repositories\Interfaces\Api\Nurseries\IBookingNurseryRepository;
use Carbon\Carbon;
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
            'children.attachmentable',
            'BookingStatus:id,name',
            'nurseries',
        ])->get();

        if ($nurseryBooking->isEmpty()) {
            return null;
        }else{
            return $nurseryBooking;
        }

    }

    public function onlineStatus(Request $request){

        if (Nursery::where('id', $request['nursery_id'])->exists()) {
            $request = Nursery::where('id', $request['nursery_id'])->update([
                'online' => $request['online_status'],
            ]);
            return $request->online;
        }else{
            return null;
        }

    }
    public function rejectBooking()
    {
        $user_id = auth('api')->user()->id;
        $nursery_id=Nursery::where('user_id',$user_id)->pluck('id');
        $nurseryBooking=Booking::whereIn("nursery_id",$nursery_id)->where('status_id', 3)->with([
            'masters:id,uid,first_name',
            'children:id,name,date_of_birth',
            'children.attachmentable',
            'BookingStatus:id,name',
            'nurseries',
            'RejectResReasons',
        ])->get();

        if ($nurseryBooking->isEmpty()) {
            return null;
        }else{
            return $nurseryBooking;
        }


    }



    public function showBookingDetails($id)
    {

        $nurseryBooking=Booking::where('id',$id)->with([
            'masters.children:id,name,date_of_birth',
            'BookingStatus:id,name',
            'children.sicknesses',
            'children.languages:name',
            'children.allergies',
            'children.attachmentable',
        ])->get();


        if ($nurseryBooking->isEmpty()) {
            return "عذراً لايوجد أي حجوزات لعرضها.";
        }else{
            return $nurseryBooking;
        }
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


        $dateToday=now()->format('Y:m:d');
        $TimeNow=now()->format('Y:m:d');

        $booking=Booking::where('status_id',2)->whereIn('nursery_id',$nursery_id)
            ->where('booking_date', $TimeNow)
            ->pluck('id');
        $ConfirmedBooking['booking']=ConfirmedBooking::whereIn('booking_id',$booking)->whereIn('nursery_id',$nursery_id)->with([
            "Booking.children",
            "PaymentMethod",
            "bookingServices.services",
            "Booking.masters",
            'Booking.children.sicknesses',
            'Booking.children.languages:name',
            'Booking.children.allergies',
            'Booking.children.attachmentable',
        ])->get();
        if ($ConfirmedBooking==null) {
            return null;
        }else{
            return $ConfirmedBooking;
        }

    }


    public function showChildrenBooking()
    {
        $user_id = auth('api')->user()->id;
        $nursery_id=Nursery::where('user_id',$user_id)->pluck('id');


        $dateToday=now()->format('Y:m:d');
        $TimeNow=now()->format('Y:m:d');

        $booking=Booking::where('status_id',2)->whereIn('nursery_id',$nursery_id)
            ->where('booking_date', $TimeNow)
            ->pluck('id');
        $ConfirmedBooking=ConfirmedBooking::whereIn('booking_id',$booking)->whereIn('nursery_id',$nursery_id)->with([
            "Booking.children","Booking.children.attachmentable"
        ])->get();
        if ($ConfirmedBooking==null) {
            return null;
        }else{
            return BookingChildResource::collection($ConfirmedBooking);
        }
        $user_id = auth('api')->user()->id;
        $nursery_id=Nursery::where('user_id',$user_id)->pluck('id');


        $dateToday=now()->format('Y:m:d');
        $TimeNow=now()->format('Y:m:d');

        $booking=Booking::where('status_id',2)->whereIn('nursery_id',$nursery_id)
            ->where('booking_date', $TimeNow)
            ->pluck('child_id');
        return $booking;
        $data['child'] = Child::with(['languages', 'attachmentable','bookingService.service'])
            ->where('id', $booking)
            ->get();
        if ($data->isEmpty()) {
            return null;
        }else{
            return $data;
        }

    }


}
