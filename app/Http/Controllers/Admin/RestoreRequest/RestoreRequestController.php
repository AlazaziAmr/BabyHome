<?php

namespace App\Http\Controllers\Admin\RestoreRequest;

use App\Http\Controllers\Controller;
use App\Helpers\JsonResponse;
use App\Http\Resources\Api\Admin\RestoreRequest\RestoreRequestResource;
use App\Models\User;
use App\Repositories\Interfaces\Api\Admin\IRestoreRequestRepository;
use Illuminate\Http\Request;

class RestoreRequestController extends Controller
{
    private $restoreRequestRepository;

    public function __construct(IRestoreRequestRepository $restoreRequestRepository)
    {
        $this->restoreRequestRepository = $restoreRequestRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function fetchUsers()
    {
        try {
            return JsonResponse::successfulResponse('', RestoreRequestResource::collection($this->restoreRequestRepository->fetchUsers()));
        } catch (\Exception $e) {
            return JsonResponse::errorResponse($e->getMessage());
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  User $user
     * @return \Illuminate\Http\Response
     */
    public function userUpdateStatus(Request $request)
    {
        try {
            $this->restoreRequestRepository->restoreUser($request['user']);
            // TODO::notify
            return JsonResponse::successfulResponse('msg_updated_succssfully');
        } catch (\Exception $e) {
            return JsonResponse::errorResponse($e->getMessage());
        }
    }
}
