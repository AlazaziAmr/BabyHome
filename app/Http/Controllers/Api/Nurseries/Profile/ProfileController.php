<?php

namespace App\Http\Controllers\Api\Nurseries\Profile;

use App\Helpers\JsonResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Nurseries\NurseryRequest;
use App\Http\Resources\Api\Nurseries\NurseryResource;
use App\Models\Api\Nurseries\Nursery;
use App\Repositories\Interfaces\Api\Nurseries\INurseryRepository;

class ProfileController extends Controller
{
    private $nurseryRepository;

    public function __construct(INurseryRepository $nurseryRepository)
    {
        $this->nurseryRepository = $nurseryRepository;
    }

    public function profile()
    {
        try {
            $id = 1;
            $nurseries = new NurseryResource(Nursery::findOrFail($id));
            return JsonResponse::successfulResponse('msg_success', $nurseries);
        } catch (\Exception $e) {
            return JsonResponse::errorResponse($e->getMessage());
        }
    }

    public function update(NurseryRequest $request)
    {
        try {
            $nurseries = Nursery::findorFail(1);
            $this->nurseryRepository->update($request->validated(), $nurseries['id']);
            return JsonResponse::successfulResponse('msg_updated_succssfully');
        } catch (\Exception $e) {
            return JsonResponse::errorResponse($e->getMessage());
        }
    }

}
