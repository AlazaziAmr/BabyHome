<?php

namespace App\Http\Controllers\Api\Generals;

use App\Helpers\JsonResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Generals\CityRequest;
use App\Http\Resources\Api\Generals\CityResource;
use App\Http\Resources\Api\Generals\NeighborhoodResource;
use App\Models\Api\Generals\City;
use App\Repositories\Interfaces\Api\Generals\ICityRepository;

class CityController extends Controller
{

    private $cityRepository;

    public function __construct(ICityRepository $cityRepository)
    {
        $this->cityRepository = $cityRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            return JsonResponse::successfulResponse('', CityResource::collection($this->cityRepository->fetchAll(['country'])));
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
    public function store(CityRequest $request)
    {

        return JsonResponse::successfulResponse('msg_created_succssfully', $this->cityRepository->create($request->validated()));
    }

    /**
     * Display the specified resource.
     *
     * @param  City $city
     * @return \Illuminate\Http\Response
     */
    public function show(City $city)
    {
        try {
            $city = new CityResource($city->load('country'));
            return JsonResponse::successfulResponse('msg_success', $city);
        } catch (\Exception $e) {
            return JsonResponse::errorResponse($e->getMessage());
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  City $city
     * @return \Illuminate\Http\Response
     */
    public function update(CityRequest $request, City $city)
    {
        try {
            $this->cityRepository->update($request->validated(), $city['id']);
            return JsonResponse::successfulResponse('msg_updated_succssfully');
        } catch (\Exception $e) {
            return JsonResponse::errorResponse($e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  City $city
     * @return \Illuminate\Http\Response
     */
    public function destroy(City $city)
    {
        try {
            $this->cityRepository->delete($city['id']);
            return JsonResponse::successfulResponse('msg_deleted_succssfully');
        } catch (\Exception $e) {
            return JsonResponse::errorResponse($e->getMessage());
        }
    }

            /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function cityNeighborhoods(City $city)
    {
        try {
            return JsonResponse::successfulResponse('', NeighborhoodResource::collection($city->neighborhoods));
        } catch (\Exception $e) {
            return JsonResponse::errorResponse($e->getMessage());
        }
    }
}
