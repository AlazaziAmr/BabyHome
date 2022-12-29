<?php

namespace App\Repositories\Classes\Api\Nurseries;

use App\Http\Resources\Api\Nurseries\BookingActivityResource;
use App\Http\Resources\Api\Nurseries\BookingActivityTodayResource;
use App\Models\Api\Generals\Activity;
use App\Models\Api\Generals\Service;
use App\Models\Api\Master\Booking\RejectResReasons;
use App\Models\Api\Master\BookingServices\Booking;
use App\Models\Api\Master\BookingServices\BookingLog;
use App\Models\Api\Master\BookingServices\BookingService;
use App\Models\Api\Master\BookingServices\ConfirmedBooking;
use App\Models\Api\Master\Child;
use App\Models\Api\Nurseries\JoinRequest\JoinRequest;
use App\Models\Api\Nurseries\Nursery;
use App\Models\Api\Nurseries\NurseryActivity;
use App\Repositories\Classes\BaseRepository;
use App\Repositories\Interfaces\Api\Nurseries\IActivityNurseryRepository;
use App\Repositories\Interfaces\Api\Nurseries\IBookingNurseryRepository;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use function Symfony\Component\Translation\t;


class ActivityNuseryRepository extends BaseRepository implements IActivityNurseryRepository
{
    public function model()
    {
        return JoinRequest::class;
    }

    public function Nursery()
    {
        return Nursery::class;
    }
    public function showActivityToday()
    {
        $user_id = user()->id;
        $nursery_id= Nursery::where('user_id',$user_id)->pluck('id')->toArray();
        $dateToday= now()->format('Y:m:d');
      //  $TimeNow= now()->format('Y:m:d');
//        $booking= Booking::where('status_id',2)->whereIn('nursery_id',$nursery_id)->where('booking_date',$dateToday)
        $booking= Booking::where('status_id',2)->whereIn('nursery_id',$nursery_id)
            ->where('booking_date',$dateToday)
            ->pluck('id')->toArray();
        $ConfirmedBooking= ConfirmedBooking::whereIn('booking_id',$booking)->whereIn('nursery_id',$nursery_id)
            ->where('status',2)
            ->pluck('booking_id')->toArray();

        $service_id= DB::table('booking_services')->whereIn('booking_id',$ConfirmedBooking)
            ->select('service_id')->groupByRaw('service_id')
            ->pluck('service_id')->toArray();

        $BookingServices['service_booking'] = BookingService::select('id','service_id','booking_id')->whereIn('booking_id',$ConfirmedBooking)
            ->whereIn('nursery_id',$nursery_id)->get();

        $Services = Service::whereIn('id',$service_id)->with(['booking_service','booking_service.childrens','attachmentable'])->get();

        if (!$BookingServices) {
            return null;
        }else{
            //   return  $BookingServices;

//            $BookingServices['services']= BookingActivityTodayResource::collection($Services);
//            $BookingServices['services']= BookingActivityTodayResource::collection($BookingServices['service_booking']);

            return  BookingActivityTodayResource::collection($Services);
        }
    }
    public function showAllActivityBooking()
    {
        $user_id = auth('api')->user()->id;
        $nursery_id=Nursery::where('user_id',$user_id)->pluck('id');
        $nurseryBooking=BookingService::whereIn("nursery_id",$nursery_id)->with([
            'services'
        ])->get();

        if ($nurseryBooking->isEmpty()) {
            return null;
        }else{
            return $nurseryBooking;
        }
    }
    public function showDetailsActivityComplate()
    {
        $user_id = auth('api')->user()->id;
        $nursery_id=Nursery::where('user_id',$user_id)->pluck('id');
        $nurseryBooking=BookingService::whereIn("nursery_id",$nursery_id)->with([
            'services'
        ])->get();

        if ($nurseryBooking->isEmpty()) {
            return null;
        }else{
            return $nurseryBooking;
        }
    }



    public function addActivity($request)
    {
        // TODO: Implement addActivity() method.


        $addActivity = Activity::create([
            'name' => $request['name'],
            'description' => $request['description'],
            'unit' => $request['unit'],
            'price' => $request['price'],
            'is_paid' => $request['is_paid'],
            'is_active' => $request['is_active'],
            'type_id' => $request['type_id'],
            'user_id' => $request['user_id'],
        ]);
        $addActivities=$addActivity->id;

        $Nurseryactivity=$this->nurseryActivity($request,$addActivities);

        return $addActivity;
    }
    public function nurseryActivity($request,$addActivities){
        if($request['nursery_id'] ==null){
            $user_id = auth('api')->user()->id;
            $nursery_id=Nursery::where('user_id',$user_id)->pluck('id');
        }else{
            $nursery_id=$request['nursery_id'];
        }
        foreach ($nursery_id as $nursery) {
            $addActivity = NurseryActivity::create([
                'activity_id' => $addActivities,
                'nursery_id' => $nursery,

            ]);
        }

    }

}
