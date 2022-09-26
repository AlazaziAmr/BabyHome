<?php

namespace App\Http\Controllers\Api\Generals;

use App\Helpers\JsonResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Generals\GenderRequest;
use App\Http\Resources\Api\Generals\GenderResource;
use App\Models\Api\Generals\Gender;
use App\Repositories\Interfaces\Api\Generals\IGenderRepository;

class GenderController extends Controller
{
    private $genderRepository;

    public function __construct(IGenderRepository $genderRepository)
    {
        $this->genderRepository = $genderRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            return JsonResponse::successfulResponse('', GenderResource::collection($this->genderRepository->fetchAll()));
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
    public function store(GenderRequest $request)
    {
        return JsonResponse::successfulResponse('msg_created_succssfully', $this->genderRepository->create($request->validated()));
    }

    /**
     * Display the specified resource.
     *
     * @param  Gender $gender
     * @return \Illuminate\Http\Response
     */
    public function show(Gender $gender)
    {
        try {
            $gender = new GenderResource($gender);
            return JsonResponse::successfulResponse('msg_success', $gender);
        } catch (\Exception $e) {
            return JsonResponse::errorResponse($e->getMessage());
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Gender $gender
     * @return \Illuminate\Http\Response
     */
    public function update(GenderRequest $request, Gender $gender)
    {
        try {
            $this->genderRepository->update($request->validated(), $gender['id']);
            return JsonResponse::successfulResponse('msg_updated_succssfully');
        } catch (\Exception $e) {
            return JsonResponse::errorResponse($e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Gender $gender
     * @return \Illuminate\Http\Response
     */
    public function destroy(Gender $gender)
    {
        try {
            $this->genderRepository->delete($gender['id']);
            return JsonResponse::successfulResponse('msg_deleted_succssfully');
        } catch (\Exception $e) {
            return JsonResponse::errorResponse($e->getMessage());
        }
    }
}
