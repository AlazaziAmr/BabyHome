<?php

namespace App\Http\Controllers\Api\Generals;

use App\Helpers\JsonResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Generals\NeighborhoodRequest;
use App\Http\Resources\Api\Generals\NeighborhoodResource;
use App\Models\Api\Generals\Neighborhood;
use App\Repositories\Interfaces\Api\Generals\INeighborhoodRepository;
use Illuminate\Http\Request;

class NeighborhoodController extends Controller
{

    private $neighborhoodRepository;

    public function __construct(INeighborhoodRepository $neighborhoodRepository)
    {
        $this->neighborhoodRepository = $neighborhoodRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        try {
            if($request->city_id){
                return JsonResponse::successfulResponse('', NeighborhoodResource::collection($this->neighborhoodRepository->cityNeighbirhoods($request->city_id)));
            }
            return JsonResponse::successfulResponse('', NeighborhoodResource::collection($this->neighborhoodRepository->fetchAll()));
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
    public function store(NeighborhoodRequest $request)
    {

        return JsonResponse::successfulResponse('msg_created_succssfully', $this->neighborhoodRepository->create($request->validated()));
    }

    /**
     * Display the specified resource.
     *
     * @param  Neighborhood $neighborhood
     * @return \Illuminate\Http\Response
     */
    public function show(Neighborhood $neighborhood)
    {
        try {
            $neighborhood = new NeighborhoodResource($neighborhood);
            return JsonResponse::successfulResponse('msg_success', $neighborhood);
        } catch (\Exception $e) {
            return JsonResponse::errorResponse($e->getMessage());
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Neighborhood $neighborhood
     * @return \Illuminate\Http\Response
     */
    public function update(NeighborhoodRequest $request, Neighborhood $neighborhood)
    {
        try {
            $this->neighborhoodRepository->update($request->validated(), $neighborhood['id']);
            return JsonResponse::successfulResponse('msg_updated_succssfully');
        } catch (\Exception $e) {
            return JsonResponse::errorResponse($e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Neighborhood $neighborhood
     * @return \Illuminate\Http\Response
     */
    public function destroy(Neighborhood $neighborhood)
    {
        try {
            $this->neighborhoodRepository->delete($neighborhood['id']);
            return JsonResponse::successfulResponse('msg_deleted_succssfully');
        } catch (\Exception $e) {
            return JsonResponse::errorResponse($e->getMessage());
        }
    }
}
