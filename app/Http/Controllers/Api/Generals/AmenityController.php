<?php

namespace App\Http\Controllers\Api\Generals;

use App\Helpers\JsonResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Generals\AmenityRequest;
use App\Http\Resources\Api\Generals\AmenityResource;
use App\Models\Api\Generals\Amenity;
use App\Repositories\Interfaces\Api\Generals\IAmenityRepository;

class AmenityController extends Controller
{
    private $amenityRepository;

    public function __construct(IAmenityRepository $amenityRepository)
    {
        $this->amenityRepository = $amenityRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            return JsonResponse::successfulResponse('', AmenityResource::collection($this->amenityRepository->fetchAll()));
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
    public function store(AmenityRequest $request)
    {
        return JsonResponse::successfulResponse('msg_created_succssfully', $this->amenityRepository->create($request->validated()));
    }

    /**
     * Display the specified resource.
     *
     * @param  Amenity $amenity
     * @return \Illuminate\Http\Response
     */
    public function show(Amenity $amenity)
    {
        try {
            $amenity = new AmenityResource($amenity);
            return JsonResponse::successfulResponse('msg_success', $amenity);
        } catch (\Exception $e) {
            return JsonResponse::errorResponse($e->getMessage());
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Amenity $amenity
     * @return \Illuminate\Http\Response
     */
    public function update(AmenityRequest $request, Amenity $amenity)
    {
        try {
            $this->amenityRepository->update($request->validated(), $amenity['id']);
            return JsonResponse::successfulResponse('msg_updated_succssfully');
        } catch (\Exception $e) {
            return JsonResponse::errorResponse($e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Amenity $amenity
     * @return \Illuminate\Http\Response
     */
    public function destroy(Amenity $amenity)
    {
        try {
            $this->amenityRepository->delete($amenity['id']);
            return JsonResponse::successfulResponse('msg_deleted_succssfully');
        } catch (\Exception $e) {
            return JsonResponse::errorResponse($e->getMessage());
        }
    }
}
