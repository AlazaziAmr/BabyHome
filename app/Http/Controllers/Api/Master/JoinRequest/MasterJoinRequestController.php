<?php

namespace App\Http\Controllers\Api\Master\JoinRequest;

use App\Helpers\JsonResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Master\JoinRequest\MasterJoinRequest;
use App\Repositories\Interfaces\Api\Master\IMasterJoinRequestRepository;
use App\Repositories\Interfaces\Api\Nurseries\IJoinRequestRepository;
use Illuminate\Http\Request;

class MasterJoinRequestController extends Controller
{
    private $joinRequestRepository;

    public function __construct(IMasterJoinRequestRepository $joinRequestRepository)
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

        return JsonResponse::successfulResponse('msg_created_succssfully', $this->joinRequestRepository->createRequest($request->validated()));
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
}
