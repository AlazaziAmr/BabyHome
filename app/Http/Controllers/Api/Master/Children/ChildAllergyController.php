<?php

namespace App\Http\Controllers\Api\Master\Children;

use App\Helpers\JsonResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Master\Children\ChildAllergyRequest;
use App\Http\Resources\Api\Master\Children\ChildAllergyResource;
use App\Models\Api\Master\ChildAllergy;
use App\Repositories\Interfaces\Api\Master\IChildAllergyRepository;

class ChildAllergyController extends Controller
{
    private $allergySicknessRepository;

    public function __construct(IChildAllergyRepository $allergySicknessRepository)
    {
        $this->childAllergyRepository = $allergySicknessRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($child_id)
    {
        try {
            return JsonResponse::successfulResponse('', ChildAllergyResource::collection($this->childAllergyRepository->fetchForChild($child_id)));
        } catch (\Exception $e) {
            return JsonResponse::errorResponse($e->getMessage());
        }
    }

    public function store(ChildAllergyRequest $request)
    {
        return JsonResponse::successfulResponse('msg_created_succssfully', $this->childAllergyRepository->create($request->validated()));
    }

    public function update(ChildAllergyRequest $request, $id)
    {
        try {
            $allergy = ChildAllergy::findOrFail($id);
            $this->childAllergyRepository->update($request->validated(), $allergy['id']);
            return JsonResponse::successfulResponse('msg_updated_succssfully');
        } catch (\Exception $e) {
            return JsonResponse::errorResponse($e->getMessage());
        }
    }

    public function destroy($id)
    {
        try {
            $allergy = ChildAllergy::findOrFail($id);
            $this->childAllergyRepository->delete($allergy['id']);
            return JsonResponse::successfulResponse('msg_deleted_succssfully');
        } catch (\Exception $e) {
            return JsonResponse::errorResponse($e->getMessage());
        }
    }
}
