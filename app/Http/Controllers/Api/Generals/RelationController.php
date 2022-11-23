<?php

namespace App\Http\Controllers\Api\Generals;

use App\Helpers\JsonResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Generals\RelationRequest;
use App\Http\Resources\Api\Generals\RelationResource;
use App\Models\Api\Generals\Relative;
use App\Repositories\Interfaces\Api\Generals\IRelationRepository;

class RelationController extends Controller
{
    private $relationRepository;

    public function __construct(IRelationRepository $relationRepository)
    {
        $this->relationRepository = $relationRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            return JsonResponse::successfulResponse('', RelationResource::collection($this->relationRepository->fetchAll()));
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
    public function store(RelationRequest $request)
    {
        return JsonResponse::successfulResponse('msg_created_succssfully', $this->relationRepository->create($request->validated()));
    }

    /**
     * Display the specified resource.
     *
     * @param  Relative $relation
     * @return \Illuminate\Http\Response
     */
    public function show(Relative $relation)
    {
        try {
            $relation = new RelationResource($relation);
            return JsonResponse::successfulResponse('msg_success', $relation);
        } catch (\Exception $e) {
            return JsonResponse::errorResponse($e->getMessage());
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Relative $relation
     * @return \Illuminate\Http\Response
     */
    public function update(RelationRequest $request, Relative $relation)
    {
        try {
            $this->relationRepository->update($request->validated(), $relation['id']);
            return JsonResponse::successfulResponse('msg_updated_succssfully');
        } catch (\Exception $e) {
            return JsonResponse::errorResponse($e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Relative $relation
     * @return \Illuminate\Http\Response
     */
    public function destroy(Relative $relation)
    {
        try {
            $this->relationRepository->delete($relation['id']);
            return JsonResponse::successfulResponse('msg_deleted_succssfully');
        } catch (\Exception $e) {
            return JsonResponse::errorResponse($e->getMessage());
        }
    }
}
