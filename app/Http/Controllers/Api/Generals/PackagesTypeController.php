<?php

namespace App\Http\Controllers\Api\Generals;

use App\Helpers\JsonResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Generals\PackagesTypeRequest;
use App\Http\Resources\Api\Generals\PackagesTypeResource;
use App\Models\Api\Generals\PackagesType;
use App\Repositories\Interfaces\Api\Generals\IPackagesTypeRepository;

class PackagesTypeController extends Controller
{
    private $packagesTypeRepository;

    public function __construct(IPackagesTypeRepository $packagesTypeRepository)
    {
        $this->packagesTypeRepository = $packagesTypeRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            return JsonResponse::successfulResponse('', PackagesTypeResource::collection($this->packagesTypeRepository->fetchAllActive()));
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
    public function store(PackagesTypeRequest $request)
    {
        return JsonResponse::successfulResponse('msg_created_succssfully', $this->packagesTypeRepository->create($request->validated()));
    }

    /**
     * Display the specified resource.
     *
     * @param  PackagesType $packagesType
     * @return \Illuminate\Http\Response
     */
    public function show(PackagesType $packagesType)
    {
        try {
            $packagesType = new PackagesTypeResource($packagesType);
            return JsonResponse::successfulResponse('msg_success', $packagesType);
        } catch (\Exception $e) {
            return JsonResponse::errorResponse($e->getMessage());
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  PackagesType $packagesType
     * @return \Illuminate\Http\Response
     */
    public function update(PackagesTypeRequest $request, PackagesType $packagesType)
    {
        try {
            $this->packagesTypeRepository->update($request->validated(), $packagesType['id']);
            return JsonResponse::successfulResponse('msg_updated_succssfully');
        } catch (\Exception $e) {
            return JsonResponse::errorResponse($e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  PackagesType $packagesType
     * @return \Illuminate\Http\Response
     */
    public function destroy(PackagesType $packagesType)
    {
        try {
            $this->packagesTypeRepository->delete($packagesType['id']);
            return JsonResponse::successfulResponse('msg_deleted_succssfully');
        } catch (\Exception $e) {
            return JsonResponse::errorResponse($e->getMessage());
        }
    }
}
