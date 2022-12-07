<?php

namespace App\Http\Controllers\Api\Nurseries\Activities;

use App\Helpers\JsonResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Master\Booking\BookingRequest;
use App\Http\Requests\Api\Nurseries\ActivityRequest;
use App\Models\Api\Generals\Activity;
use App\Models\Api\Master\BookingServices\BookingService;
use App\Repositories\Interfaces\Api\Nurseries\IActivityNurseryRepository;
use App\Repositories\Interfaces\Api\Nurseries\IBookingNurseryRepository;
use App\Traits\ApiTraits;
use Illuminate\Http\Request;

class ActivityNurseryController extends Controller
{
    private $ActivityNursery;
    use ApiTraits;

    public function __construct(IActivityNurseryRepository $ActivityNurseryRepository)
    {
        $this->ActivityNursery = $ActivityNurseryRepository;
    }
    public function model()
    {
        return BookingService::class;
    }
    public function active(Request $request){

        try {
            $requestProcess=   Activity::where('id', $request['active_id'])->where()->update([
                'is_active' => 1,
            ]);
                $msg='تم تحديث البيانات بنجاح';
                return $this->returnData($requestProcess,$msg);

        }catch (\Exception $e) {
            return JsonResponse::errorResponse($e->getMessage());
        }

    }
    public function addImageActivity(Request $request){

        try {
            $requestProcess = BookingService::where('service_id',$request->service_id)
                ->where('child_id',$request->child_id)->where('booking_id',$request->booking_id)
                ->first();
            $data = [
                'child_id' => $request->child_id,
            ];
            $requestProcess->update($data);
            if ($requestProcess) {
                if (!empty($request['attachments'])) uploadAttachment($requestProcess, $request, 'attachments', 'booking_services');
                $msg='تم إضافة المرفق  بنجاح';
                return $this->returnData($requestProcess,$msg);
            }
        }catch (\Exception $e) {
            return JsonResponse::errorResponse($e->getMessage());
        }

    }
    public function executingActivity(Request $request){

        try {
            $requestProcess = BookingService::where('service_id',$request->service_id)
                ->where('child_id',$request->child_id)->where('booking_id',$request->booking_id)
                ->first();

            $data = [
                'status' => $request->status,
            ];

            if ($requestProcess){
                $requestProcess->update($data);
                $msg='تم تحديث البيانات بنجاح';
                return $this->returnData($requestProcess,$msg);
            }
        }catch (\Exception $e) {
            return JsonResponse::errorResponse($e->getMessage());
        }

    }


    public function un_active(Request $request){
        try {
            $requestProcess=   Activity::where('id', $request['active_id'])->where()->update([
                'is_active' => 0,
            ]);
            $msg='تم تحديث البيانات بنجاح';
            return $this->returnData($requestProcess,$msg);

        }catch (\Exception $e) {
            return JsonResponse::errorResponse($e->getMessage());
        }
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        try {
            $requestProcess=$this->ActivityNursery->showActivity();
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
  /*  public function show($id)
    {



    }*/

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
