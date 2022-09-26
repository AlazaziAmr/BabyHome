<?php

namespace App\Http\Controllers\Api\Generals;

use App\Helpers\JsonResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Generals\NurseryServiceTypeRequest;
use App\Http\Resources\Api\Generals\ActivityResource;
use App\Http\Resources\Api\Generals\NurseryServiceTypeResource;
use App\Models\Api\Generals\NurseryServiceType;
use App\Repositories\Interfaces\Api\Generals\INurseryServiceTypeRepository;

class NurseryServiceTypeController extends Controller
{
    private $nurseryServiceTypeRepository;

    public function __construct(INurseryServiceTypeRepository $nurseryServiceTypeRepository)
    {
        $this->nurseryServiceTypeRepository = $nurseryServiceTypeRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            return JsonResponse::successfulResponse('', NurseryServiceTypeResource::collection($this->nurseryServiceTypeRepository->fetchAll()));
        } catch (\Exception $e) {
            return JsonResponse::errorResponse($e->getMessage());
        }
    }

    public function subServices($parent_id)
    {
        try {
            return JsonResponse::successfulResponse('', NurseryServiceTypeResource::collection($this->nurseryServiceTypeRepository->subServices($parent_id)));
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
    public function store(NurseryServiceTypeRequest $request)
    {
        return JsonResponse::successfulResponse('msg_created_succssfully', $this->nurseryServiceTypeRepository->create($request->validated()));
    }

    /**
     * Display the specified resource.
     *
     * @param  NurseryServiceType $nurseryServiceType
     * @return \Illuminate\Http\Response
     */
    public function show(NurseryServiceType $nurseryServicesType)
    {
        try {
            $nurseryServiceType = new NurseryServiceTypeResource($nurseryServicesType);
            return JsonResponse::successfulResponse('msg_success', $nurseryServiceType);
        } catch (\Exception $e) {
            return JsonResponse::errorResponse($e->getMessage());
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  NurseryServiceType $nurseryServiceType
     * @return \Illuminate\Http\Response
     */
    public function update(NurseryServiceTypeRequest $request, NurseryServiceType $nurseryServicesType)
    {
        try {
            $this->nurseryServiceTypeRepository->update($request->validated(), $nurseryServicesType['id']);
            return JsonResponse::successfulResponse('msg_updated_succssfully');
        } catch (\Exception $e) {
            return JsonResponse::errorResponse($e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  NurseryServiceType $nurseryServiceType
     * @return \Illuminate\Http\Response
     */
    public function destroy(NurseryServiceType $nurseryServicesType)
    {
        try {
            $this->nurseryServiceTypeRepository->delete($nurseryServicesType['id']);
            return JsonResponse::successfulResponse('msg_deleted_succssfully');
        } catch (\Exception $e) {
            return JsonResponse::errorResponse($e->getMessage());
        }
    }
    /**
     * Display the specified resource.
     *
     * @param  NurseryServiceType $nurseryServiceType
     * @return \Illuminate\Http\Response
     */
    public function typeActivities(NurseryServiceType $nurseryServicesType)
    {
        try {
            return JsonResponse::successfulResponse('', ActivityResource::collection($nurseryServicesType->activities));
        } catch (\Exception $e) {
            return JsonResponse::errorResponse($e->getMessage());
        }
    }
    /**
     * Display a listing of the resource.
     *
     * @param  NurseryServiceType $nurseryServiceType
     * @return \Illuminate\Http\Response
     */
    public function children(NurseryServiceType $nurseryServicesType)
    {
        try {
            return JsonResponse::successfulResponse('', NurseryServiceTypeResource::collection($nurseryServicesType->children));
        } catch (\Exception $e) {
            return JsonResponse::errorResponse($e->getMessage());
        }
    }
}
