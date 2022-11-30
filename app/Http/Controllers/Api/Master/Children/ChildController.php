<?php

namespace App\Http\Controllers\Api\Master\Children;

use App\Helpers\JsonResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Master\Children\ChildPhoneRequest;
use App\Http\Requests\Api\Master\Children\ChildRequest;
use App\Http\Resources\Api\Master\Children\ChildAllergyResource;
use App\Http\Resources\Api\Master\Children\ChildCardResource;
use App\Http\Resources\Api\Master\Children\ChildResource;
use App\Http\Resources\Api\Master\Children\ChildSicknessResource;
use App\Models\Api\Master\Child;
use App\Repositories\Interfaces\Api\Master\IChildAllergyRepository;
use App\Repositories\Interfaces\Api\Master\IChildrenRepository;
use App\Repositories\Interfaces\Api\Master\IChildSicknessRepository;

class ChildController extends Controller
{
    private $childrenRepository;
    private $allergySicknessRepository;

    public function __construct(
        IChildrenRepository $childrenRepository,
        IChildAllergyRepository $allergySicknessRepository,
        IChildSicknessRepository $sicknessSicknessRepository)
    {
        $this->childrenRepository = $childrenRepository;
        $this->childAllergyRepository = $allergySicknessRepository;
        $this->childSicknessRepository = $sicknessSicknessRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            return JsonResponse::successfulResponse('', ChildCardResource::collection($this->childrenRepository->fetchAllForCurrentUser()));
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
    public function store(ChildRequest $request)
    {
        return JsonResponse::successfulResponse('msg_created_succssfully', $this->childrenRepository->createRequest($request->validated()));
    }


    /**
     * Display the specified resource.
     *
     * @param  Child $Child
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            $data['child'] = new ChildResource($this->childrenRepository->profile($id));;
            $data['sickness'] = ChildSicknessResource::collection($this->childSicknessRepository->fetchForChild($id));
            $data['allergies'] = ChildAllergyResource::collection($this->childAllergyRepository->fetchForChild($id));

            return JsonResponse::successfulResponse('msg_success', $data);
        } catch (\Exception $e) {
            return JsonResponse::errorResponse($e->getMessage());
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Child $Child
     * @return \Illuminate\Http\Response
     */
    public function update(ChildRequest $request, Child $child)
    {
        try {
            $this->childrenRepository->update($request->validated(), $child['id']);
            return JsonResponse::successfulResponse('msg_updated_succssfully');
        } catch (\Exception $e) {
            return JsonResponse::errorResponse($e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Child $Child
     * @return \Illuminate\Http\Response
     */
    public function destroy(Child $child)
    {
        try {
            $this->childrenRepository->delete($child['id']);
            return JsonResponse::successfulResponse('msg_deleted_succssfully');
        } catch (\Exception $e) {
            return JsonResponse::errorResponse($e->getMessage());
        }
    }
}
