<?php

namespace App\Http\Controllers\Api\Master\JoinRequest;

use App\Helpers\JsonResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Master\JoinRequest\MasterJoinRequest;
use App\Repositories\Interfaces\Api\Master\IBookingRequestRepository;
use App\Repositories\Interfaces\Api\Nurseries\IJoinRequestRepository;
use Illuminate\Http\Request;

class MasterJoinRequestController extends Controller
{
    private $joinRequestRepository;

    public function __construct(IBookingRequestRepository $joinRequestRepository)
    {
        $this->joinRequestRepository = $joinRequestRepository;
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(MasterJoinRequest  $request)
    {
        try {
            return JsonResponse::successfulResponse('msg_created_succssfully', $this->joinRequestRepository->createRequest($request->validated()));
        } catch (\Exception $e) {
            return JsonResponse::errorResponse($e->getMessage());
        }
    }

    public function showNurseries()
    {
        return JsonResponse::successfulResponse('msg_created_succssfully', $this->joinRequestRepository->showNurseries());
    }

    public function filterMaster(Request $request){


        $requestProcess=$this->joinRequestRepository->filterMaster($request);
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

    public function nurseriesDetails($id){
        try {
            return JsonResponse::successfulResponse('msg_created_succssfully', $this->joinRequestRepository->nurseriesDetails( $id));
        } catch (\Exception $e) {
            return JsonResponse::errorResponse($e->getMessage());
        }

    }
}
