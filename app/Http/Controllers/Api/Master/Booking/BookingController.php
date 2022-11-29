<?php

namespace App\Http\Controllers\Api\Master\Booking;

use App\Helpers\JsonResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Master\Booking\BookingRequest;
use App\Repositories\Interfaces\Api\Master\IBookingRequestRepository;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    private $joinRequestRepository;

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
            return JsonResponse::successfulResponse('msg_activated_succssfully', $this->joinRequestRepository->confirmedShow($request));
        } catch (\Exception $e) {
            return JsonResponse::errorResponse($e->getMessage());
        }

    }
    public function rejectBooking(){

        try {
            return JsonResponse::successfulResponse('msg_activated_succssfully', $this->joinRequestRepository->rejectBooking());
        } catch (\Exception $e) {
            return JsonResponse::errorResponse($e->getMessage());
        }

    }

    public function BookingWait()
    {
        try {
            return JsonResponse::successfulResponse('msg_created_succssfully', $this->joinRequestRepository->showBooking());
        } catch (\Exception $e) {
            return JsonResponse::errorResponse($e->getMessage());
        }
    }

    public function showBookingDetails($id)
    {

        try {
            return JsonResponse::successfulResponse('msg_created_succssfully', $this->joinRequestRepository->showBookingDetails($id));
        } catch (\Exception $e) {
            return JsonResponse::errorResponse($e->getMessage());
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



    public function filterMaster(Request $request){
//        $x=Nursery::class;
//        return $x;
        try {
            return JsonResponse::successfulResponse('msg_created_succssfully', $this->joinRequestRepository->filterMaster( $request));
        } catch (\Exception $e) {
            return JsonResponse::errorResponse($e->getMessage());
        }


    }

   /* public function nurseriesDetails($id){
        try {
            return JsonResponse::successfulResponse('msg_created_succssfully', $this->joinRequestRepository->nurseriesDetails( $id));
        } catch (\Exception $e) {
            return JsonResponse::errorResponse($e->getMessage());
        }

    }*/
}
