<?php

namespace App\Repositories\Classes\Api\Nurseries;

use App\Models\Api\Generals\Activity;
use App\Models\Api\Master\Booking\RejectResReasons;
use App\Models\Api\Master\BookingServices\Booking;
use App\Models\Api\Master\BookingServices\BookingLog;
use App\Models\Api\Master\BookingServices\BookingService;
use App\Models\Api\Master\BookingServices\ConfirmedBooking;
use App\Models\Api\Nurseries\JoinRequest\JoinRequest;
use App\Models\Api\Nurseries\Nursery;
use App\Models\Api\Nurseries\NurseryActivity;
use App\Repositories\Classes\BaseRepository;
use App\Repositories\Interfaces\Api\Nurseries\IActivityNurseryRepository;
use App\Repositories\Interfaces\Api\Nurseries\IBookingNurseryRepository;
use Carbon\Carbon;
use Illuminate\Http\Request;


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

    public function showActivity()
    {
        $user_id = auth('api')->user()->id;
        $nursery_id=Nursery::where('user_id',$user_id)->pluck('id');
        $nurseryBooking=NurseryActivity::whereIn("nursery_id",$nursery_id)->with([
            'activity'
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
