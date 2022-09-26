<?php

namespace App\Http\Controllers\Api\Master\JoinRequest;

use App\Helpers\JsonResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Master\JoinRequest\MasterJoinRequest;
use App\Repositories\Interfaces\Api\Nurseries\IJoinRequestRepository;

class MasterJoinRequestController extends Controller
{
    private $joinRequestRepository;

    public function __construct(IJoinRequestRepository $joinRequestRepository)
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
}
