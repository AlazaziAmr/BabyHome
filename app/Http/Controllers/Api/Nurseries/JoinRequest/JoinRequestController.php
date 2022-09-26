<?php

namespace App\Http\Controllers\Api\Nurseries\JoinRequest;

use App\Helpers\JsonResponse;
use App\Http\Controllers\Controller;
use App\Http\Resources\Api\Nurseries\JoinRequestResource;
use App\Models\Api\Nurseries\JoinRequest\JoinRequest;
use App\Repositories\Interfaces\Api\Nurseries\IJoinRequestRepository;

class JoinRequestController extends Controller
{
    private $joinRequestRepository;

    public function __construct(IJoinRequestRepository $joinRequestRepository)
    {
        $this->joinRequestRepository = $joinRequestRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function nurseryUnapprovedJoining($id)
    {
        try {
            return JsonResponse::successfulResponse('', JoinRequestResource::collection($this->joinRequestRepository->fetchCustomerRequest($id)));
        } catch (\Exception $e) {
            return JsonResponse::errorResponse($e->getMessage());
        }
    }

}
