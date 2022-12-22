<?php

namespace App\Http\Controllers\Api\Master\Activities;

use App\Helpers\JsonResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Master\Booking\BookingRequest;
use App\Http\Requests\Api\Nurseries\ActivityRequest;
use App\Http\Resources\Api\Master\Booking\BookingServiceMasterResource;
use App\Http\Resources\Api\Master\Booking\ShowBookingServiceMasterResource;
use App\Http\Resources\Api\Nurseries\BookingServiceResource;

use App\Models\Api\Generals\Activity;
use App\Models\Api\Master\BookingServices\BookingService;
use App\Repositories\Interfaces\Api\Nurseries\IActivityNurseryRepository;
use App\Models\Api\Master\Child;
use App\Repositories\Interfaces\Api\Nurseries\IBookingNurseryRepository;
use App\Traits\ApiTraits;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class ActivityMasterController extends Controller
{
    private $ActivityNursery;
    use ApiTraits;


    public function model()
    {
        return BookingService::class;
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        try {
            $activities= BookingService::where('child_id',$request->child_id)
                ->where('nursery_id',$request->nursery_id)
                ->with([
                    'services',
                ])->get();

            /*  $user_info = DB::table('booking_services')->where('child_id',$request->child_id)
                  ->where('nursery_id',$request->nursery_id)
                  ->select('booking_id', DB::raw('count(*) as total'))
                  ->groupBy('service_id','nursery_id','booking_id','master_id')->with([ 'services'])
                  ->get();*/

            if ($activities==null ) {
                return null;
            }else{
                return ShowBookingServiceMasterResource::collection($activities);
            }


        }catch (\Exception $e) {
            return JsonResponse::errorResponse($e->getMessage());
        }

    }

    public function activityCompleteDetails(Request $request){

        try {
            $activityDetails=   BookingService::where('id',$request->id)
                ->with([
                    'children',
                    'services',
                ])->get();
            if ($activityDetails==null ) {
                return null;
            }else{
                $data= BookingServiceMasterResource::collection($activityDetails);
                return $data;
            }


        }catch (\Exception $e) {
            return JsonResponse::errorResponse($e->getMessage());
        }

    }

    public function activities(Request $request)
    {

        try {
            $requestProcess=$this->ActivityNursery->showActivityToday();
            if ($requestProcess==null){
                $msg='عذراَ لايوجد أنشطة لعرضها حالياَ';
                return $this->returnEmpty($msg);
            }else{
                $msg='تم إرجاع البيانات بنجاح';

                return $this->returnData($requestProcess,$msg);
            }
        }catch (\Exception $e) {
            return JsonResponse::errorResponse($e->getMessage());
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ActivityRequest $request)
    {

        try {
            $requestProcess=$this->ActivityNursery->addActivity($request);
            $msg='تم الحفظ  بنجاح';
            return $this->returnData($requestProcess,$msg);

        }catch (\Exception $e) {
            return JsonResponse::errorResponse($e->getMessage());
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {


    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

}
