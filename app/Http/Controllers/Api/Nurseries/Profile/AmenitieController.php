<?php

namespace App\Http\Controllers\Api\Nurseries\Profile;

use App\Helpers\JsonResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Nurseries\NurseryAmenityRequest;
use App\Http\Resources\Api\Generals\AmenityResource;
use App\Http\Resources\Api\Nurseries\Profile\NurseryAmenityResource;
use App\Models\Api\Nurseries\NurseryAmenity;
use App\Repositories\Interfaces\Api\Nurseries\Profile\INurseryAmenityRepository;
use Illuminate\Http\Request;

class AmenitieController extends Controller
{
    private $amenityRepository;

    public function __construct(INurseryAmenityRepository $amenityRepository)
    {
        $this->amenityRepository = $amenityRepository;
    }

    public function index()
    {
        try {
            return JsonResponse::successfulResponse('', NurseryAmenityResource::collection($this->amenityRepository->fetchAll(['amenity','attachmentable'])));
        } catch (\Exception $e) {
            return JsonResponse::errorResponse($e->getMessage());
        }
    }

    public function store(NurseryAmenityRequest $request)
    {
        return JsonResponse::successfulResponse('msg_created_succssfully', $this->amenityRepository->create($request->validated()));
    }
    public function show(NurseryAmenity $amenity)
    {
        try {
            $amenity = new NurseryAmenityResource($amenity->load('country'));
            return JsonResponse::successfulResponse('msg_success', $amenity);
        } catch (\Exception $e) {
            return JsonResponse::errorResponse($e->getMessage());
        }
    }
    public function update(NurseryAmenityRequest $request, NurseryAmenity $amenity)
    {
        try {
            $this->amenityRepository->update($request->validated(), $amenity['id']);
            return JsonResponse::successfulResponse('msg_updated_succssfully');
        } catch (\Exception $e) {
            return JsonResponse::errorResponse($e->getMessage());
        }
    }

    public function destroy(NurseryAmenity $amenity)
    {
        try {
            $this->amenityRepository->delete($amenity['id']);
            return JsonResponse::successfulResponse('msg_deleted_succssfully');
        } catch (\Exception $e) {
            return JsonResponse::errorResponse($e->getMessage());
        }
    }

}
