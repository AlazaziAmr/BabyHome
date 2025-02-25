<?php

namespace App\Http\Controllers\Api\Nurseries\Booking;

use App\Helpers\JsonResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Master\Booking\BookingRequest;
use App\Http\Resources\Api\Nurseries\NurseryResource;
use App\Models\Api\Nurseries\Nursery;
use App\Repositories\Interfaces\Api\Nurseries\IBookingNurseryRepository;
use App\Traits\ApiTraits;
use Illuminate\Http\Request;

class BookingNurseryController extends Controller
{
    private $BookingNursery;
    use ApiTraits;

    public function __construct(IBookingNurseryRepository $bookingNurseryRepository)
    {
        $this->BookingNursery = $bookingNurseryRepository;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        try {
            $requestProcess=$this->BookingNursery->showBooking();
            if ($requestProcess==null){
                $msg='عذراَ لايوجد حجوزات لعرضها حالياَ';
                return $this->returnEmpty($msg);
            }else{
                $msg='تم إرجاع البيانات بنجاح';
                return $this->returnData($requestProcess,$msg);
            }
        }catch (\Exception $e) {
            return JsonResponse::errorResponse($e->getMessage());
        }
    }
    public function confirmed(Request $request){

        try {
            return JsonResponse::successfulResponse('msg_activated_succssfully', $this->BookingNursery->confirmed($request));
        } catch (\Exception $e) {
            return JsonResponse::errorResponse($e->getMessage());
        }

    }
    public function confirmedShow(Request $request){

        try {
            $requestProcess=$this->BookingNursery->confirmedShow($request);

            if ($requestProcess==null){
                $msg='عذراَ لايوجد حجوزات تم الموافقة عليها لعرضها حالياَ';
                return $this->returnEmpty($msg);
            }else{
              //  $accept=__("booking.accept");
                $msg='تم إرجاع البيانات بنجاح';
                return $this->returnData($requestProcess,$msg);
            }
        }catch (\Exception $e) {
            return JsonResponse::errorResponse($e->getMessage());
        }
    }
    public function showChildrenBooking(){

        try {
            $requestProcess=$this->BookingNursery->showChildrenBooking();

            if ($requestProcess==null){
                $msg='عذراَ لايوجدأطفال حالياَ';
                return $this->returnEmpty($msg);
            }else{
                $msg='تم إرجاع البيانات بنجاح';
                return $this->returnData($requestProcess,$msg);
            }
        }catch (\Exception $e) {
            return JsonResponse::errorResponse($e->getMessage());
        }
    }
    public function showAllChildrenBooking(){

        try {
            $requestProcess=$this->BookingNursery->showAllChildrenBooking();

            if ($requestProcess==null){
                $msg='عذراَ لايوجدأطفال حالياَ';
                return $this->returnEmpty($msg);
            }else{
                $msg='تم إرجاع البيانات بنجاح';
                return $this->returnData($requestProcess,$msg);
            }
        }catch (\Exception $e) {
            return JsonResponse::errorResponse($e->getMessage());
        }
    }
    public function rejected(Request $request){
        try {
            return JsonResponse::successfulResponse('msg_created_succssfully', $this->BookingNursery->rejected($request));
        } catch (\Exception $e) {
            return JsonResponse::errorResponse($e->getMessage());
        }

    }
    public function rejectBooking(){

        try {
            $requestProcess=$this->BookingNursery->rejectBooking();
            if ($requestProcess==null){
                $msg='عذراَ لايوجد حجوزات تم رفضها لعرضها حالياَ';
                return $this->returnEmpty($msg);
            }else{
                $msg='تم إرجاع البيانات بنجاح';
                return $this->returnData($requestProcess,$msg);
            }
        }catch (\Exception $e) {
            return JsonResponse::errorResponse($e->getMessage());
        }

    }

    public function onlineStatus(Request $request){
        try {

            $requestProcess=$this->BookingNursery->onlineStatus($request);
            if ($requestProcess == null){
                $msg=' يرجئ التأكد من وجود الحاضنة';
                return $this->returnEmpty($msg);
            }else{
//                $msg='تم  التفعيل بنجاح';
                return JsonResponse::successfulResponse('تم التحديث بنجاح',new NurseryResource(Nursery::where('id',$request->nursery_id)->with(['country','city','owner','neighborhood'])->first()));
//                return $this->returnData($requestProcess,$msg);
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
    public function store(BookingRequest $request)
    {



    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        $requestProcess=$this->BookingNursery->showBookingDetails($id);
        if ($requestProcess==null){
            return response()->json([
                'status'=>false,
                'err'=>'500',
                'msg'=>'غذراَ لايوجد بيانات لعرضها',
                'data'=>$requestProcess
            ]);
        }else{
            return response()->json([
                'status'=>true,
                'msg'=>'تم إرجاع البيانات بنجاح',
                'data'=>$requestProcess
            ]);
        }

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
