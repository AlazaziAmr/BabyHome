<?php

namespace App\Http\Controllers\Api\Nurseries\Profile;

use App\Helpers\JsonResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Nurseries\NurseryServiceRequest;
use App\Http\Resources\Api\Nurseries\Profile\NurseryServiceResource;
use App\Models\Api\Nurseries\NurseryService;
use App\Repositories\Interfaces\Api\Nurseries\Profile\INurseryServiceRepository;
use Illuminate\Http\Request;

class NurseryServiceInfoController extends Controller
{
    private $serviceRepository;

    public function __construct(INurseryServiceRepository $serviceRepository)
    {
        $this->serviceRepository = $serviceRepository;
    }

    public function index()
    {
        try {
            $services = $this->serviceRepository->nursery_services(['service', 'service.attachmentable','service.type','service.sub_type']);
            return JsonResponse::successfulResponse('', NurseryServiceResource::collection($services));
        } catch (\Exception $e) {
            return JsonResponse::errorResponse($e->getMessage());
        }
    }

    public function store(NurseryServiceRequest $request)
    {
        return JsonResponse::successfulResponse('msg_created_succssfully', $this->serviceRepository->create($request->validated()));
    }

    public function show(NurseryService $service)
    {
        try {
            $service = new NurseryServiceResource($service->load(['service', 'service.attachmentable','service.type','service.sub_type']));
            return JsonResponse::successfulResponse('msg_success', $service);
        } catch (\Exception $e) {
            return JsonResponse::errorResponse($e->getMessage());
        }
    }
    public function update(NurseryServiceRequest $request, $service_id)
    {
        try {
            $this->serviceRepository->update($request->validated(), $service_id);
            return JsonResponse::successfulResponse('msg_updated_succssfully');
        } catch (\Exception $e) {
            return JsonResponse::errorResponse($e->getMessage());
        }
    }

    public function destroy($service_id)
    {
        try {
            $this->serviceRepository->delete($service_id);
            return JsonResponse::successfulResponse('msg_deleted_succssfully');
        } catch (\Exception $e) {
            return JsonResponse::errorResponse($e->getMessage());
        }
    }

    public function delete_attachment($image_id)
    {
        try {
            $this->serviceRepository->delete_attachment($image_id);
            return JsonResponse::successfulResponse('msg_deleted_succssfully');
        } catch (\Exception $e) {
            return JsonResponse::errorResponse($e->getMessage());
        }
    }

}
