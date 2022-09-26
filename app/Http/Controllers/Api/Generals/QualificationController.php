<?php

namespace App\Http\Controllers\Api\Generals;

use App\Helpers\JsonResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Generals\QualificationRequest;
use App\Http\Resources\Api\Generals\QualificationResource;
use App\Models\Api\Generals\Qualification;
use App\Repositories\Interfaces\Api\Generals\IQualificationRepository;

class QualificationController extends Controller
{
    private $qualificationRepository;

    public function __construct(IQualificationRepository $qualificationRepository)
    {
        $this->qualificationRepository = $qualificationRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            return JsonResponse::successfulResponse('', QualificationResource::collection($this->qualificationRepository->fetchAll()));
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
    public function store(QualificationRequest $request)
    {
        return JsonResponse::successfulResponse('msg_created_succssfully', $this->qualificationRepository->create($request->validated()));
    }

    /**
     * Display the specified resource.
     *
     * @param  Qualification $qualification
     * @return \Illuminate\Http\Response
     */
    public function show(Qualification $qualification)
    {
        try {
            $qualification = new QualificationResource($qualification);
            return JsonResponse::successfulResponse('msg_success', $qualification);
        } catch (\Exception $e) {
            return JsonResponse::errorResponse($e->getMessage());
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Qualification $qualification
     * @return \Illuminate\Http\Response
     */
    public function update(QualificationRequest $request, Qualification $qualification)
    {
        try {
            $this->qualificationRepository->update($request->validated(), $qualification['id']);
            return JsonResponse::successfulResponse('msg_updated_succssfully');
        } catch (\Exception $e) {
            return JsonResponse::errorResponse($e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Qualification $qualification
     * @return \Illuminate\Http\Response
     */
    public function destroy(Qualification $qualification)
    {
        try {
            $this->qualificationRepository->delete($qualification['id']);
            return JsonResponse::successfulResponse('msg_deleted_succssfully');
        } catch (\Exception $e) {
            return JsonResponse::errorResponse($e->getMessage());
        }
    }
}
