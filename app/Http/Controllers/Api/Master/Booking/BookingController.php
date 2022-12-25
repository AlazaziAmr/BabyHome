<?php

namespace App\Http\Controllers\Api\Master\Booking;

use App\Helpers\JsonResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Master\Booking\BookingRequest;
use App\Repositories\Interfaces\Api\Master\IBookingRequestRepository;
use App\Traits\ApiTraits;
use Dflydev\DotAccessData\Data;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    private $joinRequestRepository;
    use ApiTraits;

    public function __construct(IBookingRequestRepository $joinRequestRepository)
    {
        $this->joinRequestRepository = $joinRequestRepository;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return JsonResponse::successfulResponse('msg_created_succssfully', $this->joinRequestRepository->showNurseries());
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
       /* $phone="+967775070264";

        $fcm = new FcmNotification();
        $fcm->save_notification( 'تم التسجيل بنجاح', 'عزيزنا ',$request['master_id'],$phone);
        dd( $fcm);*/

        try {
            return JsonResponse::successfulResponse('msg_created_succssfully', $this->joinRequestRepository->createRequest($request));
        } catch (\Exception $e) {
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
        try {
            return JsonResponse::successfulResponse('msg_created_succssfully', $this->joinRequestRepository->nurseriesDetails( $id));
        } catch (\Exception $e) {
            return JsonResponse::errorResponse($e->getMessage());
        }
    }

    public function confirmedShow(Request $request){
        try {
            $requestProcess=$this->joinRequestRepository->confirmedShow($request);
            if ($requestProcess==null){
                $msg='عذراَ لايوجد حجوزات تم الموافقة عليها لعرضها حالياَ';
                return $this->returnEmpty($msg);
            }else{
                $msg='تم إرجاع البيانات بنجاح';
                return $this->returnData($requestProcess,$msg);
            }
        }catch (\Exception $e) {
            return JsonResponse::errorResponse($e->getMessage());
        }



    }
    public function rejectBooking(){

        try {
            $requestProcess=$this->joinRequestRepository->rejectBooking();
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

    public function BookingWait()
    {
        try {
            $requestProcess=$this->joinRequestRepository->showBooking();
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

    public function showBookingDetails($id)
    {

        $requestProcess=$this->joinRequestRepository->showBookingDetails($id);
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
    public function filterMaster(Request $request){

        $requestProcess=$this->joinRequestRepository->filterMaster( $request);
        if ($requestProcess->data==null){
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
