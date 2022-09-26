<?php

namespace App\Http\Controllers\Api\Generals;

use App\Helpers\JsonResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Generals\UtilityRequest;
use App\Http\Resources\Api\Generals\UtilityResource;
use App\Models\Api\Generals\Utility;
use App\Repositories\Interfaces\Api\Generals\IUtilityRepository;

class UtilityController extends Controller
{
    private $utilityRepository;

    public function __construct(IUtilityRepository $utilityRepository)
    {
        $this->utilityRepository = $utilityRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            return JsonResponse::successfulResponse('', UtilityResource::collection($this->utilityRepository->fetchAll()));
        } catch (\Exception $e) {
            return JsonResponse::errorResponse($e->getMessage());
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UtilityRequest $request)
    {
        return JsonResponse::successfulResponse('msg_created_succssfully', $this->utilityRepository->create($request->validated()));
    }

    /**
     * Display the specified resource.
     *
     * @param  Utility $utility
     * @return \Illuminate\Http\Response
     */
    public function show(Utility $utility)
    {
        try {
            $utility = new UtilityResource($utility);
            return JsonResponse::successfulResponse('msg_success', $utility);
        } catch (\Exception $e) {
            return JsonResponse::errorResponse($e->getMessage());
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Utility $utility
     * @return \Illuminate\Http\Response
     */
    public function update(UtilityRequest $request, Utility $utility)
    {
        try {
            $this->utilityRepository->update($request->validated(), $utility['id']);
            return JsonResponse::successfulResponse('msg_updated_succssfully');
        } catch (\Exception $e) {
            return JsonResponse::errorResponse($e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Utility $utility
     * @return \Illuminate\Http\Response
     */
    public function destroy(Utility $utility)
    {
        try {
            $this->utilityRepository->delete($utility['id']);
            return JsonResponse::successfulResponse('msg_deleted_succssfully');
        } catch (\Exception $e) {
            return JsonResponse::errorResponse($e->getMessage());
        }
    }
}
