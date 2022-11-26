<?php

namespace App\Http\Controllers\Api\Nurseries\Booking;

use App\Helpers\JsonResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Master\Booking\BookingRequest;
use App\Repositories\Interfaces\Api\Nurseries\IBookingNurseryRepository;
use Illuminate\Http\Request;

class BookingNurseryController extends Controller
{
    private $BookingNursery;

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
            return JsonResponse::successfulResponse('msg_created_succssfully', $this->BookingNursery->showBooking());
        } catch (\Exception $e) {
            return JsonResponse::errorResponse($e->getMessage());
        }
    }

    public function rejected($request){

        try {
            return JsonResponse::successfulResponse('msg_created_succssfully', $this->BookingNursery->rejected($request));
        } catch (\Exception $e) {
            return JsonResponse::errorResponse($e->getMessage());
        }

    }
    public function confirmed($request){

        try {
            return JsonResponse::successfulResponse('msg_created_succssfully', $this->BookingNursery->confirmed($request));
        } catch (\Exception $e) {
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
