<?php

namespace App\Http\Controllers\Api\Master\Children;

use App\Helpers\JsonResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Master\Children\ChildSicknessRequest;
use App\Http\Resources\Api\Master\Children\ChildSicknessResource;
use App\Models\Api\Master\ChildSickness;
use App\Repositories\Interfaces\Api\Master\IChildSicknessRepository;

class ChildSicknessController extends Controller
{
    private $sicknessSicknessRepository;

    public function __construct(IChildSicknessRepository $sicknessSicknessRepository)
    {
        $this->childSicknessRepository = $sicknessSicknessRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($child_id)
    {
        try {
            return JsonResponse::successfulResponse('', ChildSicknessResource::collection($this->childSicknessRepository->fetchForChild($child_id)));
        } catch (\Exception $e) {
            return JsonResponse::errorResponse($e->getMessage());
        }
    }

    public function store(ChildSicknessRequest $request)
    {
        return JsonResponse::successfulResponse('msg_created_succssfully', $this->childSicknessRepository->create($request->validated()));
    }

    public function update(ChildSicknessRequest $request, $id)
    {
        try {
            $sickness = ChildSickness::findOrFail($id);
            $this->childSicknessRepository->update($request->validated(), $sickness['id']);
            return JsonResponse::successfulResponse('msg_updated_succssfully');
        } catch (\Exception $e) {
            return JsonResponse::errorResponse($e->getMessage());
        }
    }

    public function destroy($id)
    {
        try {
            $sickness = ChildSickness::findOrFail($id);
            $this->childSicknessRepository->delete($sickness['id']);
            return JsonResponse::successfulResponse('msg_deleted_succssfully');
        } catch (\Exception $e) {
            return JsonResponse::errorResponse($e->getMessage());
        }
    }
}
