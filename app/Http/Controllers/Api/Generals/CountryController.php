<?php

namespace App\Http\Controllers\Api\Generals;

use App\Helpers\JsonResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Generals\CountryRequest;
use App\Http\Resources\Api\Generals\CityResource;
use App\Http\Resources\Api\Generals\CountryResource;
use App\Models\Api\Generals\Country;
use App\Repositories\Interfaces\Api\Generals\ICountryRepository;

class CountryController extends Controller
{

    private $countryRepository;

    public function __construct(ICountryRepository $countryRepository)
    {
        $this->countryRepository = $countryRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            return JsonResponse::successfulResponse('', CountryResource::collection($this->countryRepository->fetchAll()));
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
    public function store(CountryRequest $request)
    {
        return JsonResponse::successfulResponse('msg_created_succssfully', $this->countryRepository->create($request->validated()));
    }

    /**
     * Display the specified resource.
     *
     * @param  Country $country
     * @return \Illuminate\Http\Response
     */
    public function show(Country $country)
    {
        try {
            $country = new CountryResource($country);
            return JsonResponse::successfulResponse('msg_success', $country);
        } catch (\Exception $e) {
            return JsonResponse::errorResponse($e->getMessage());
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Country $country
     * @return \Illuminate\Http\Response
     */
    public function update(CountryRequest $request, Country $country)
    {
        try {
            $this->countryRepository->update($request->validated(), $country['id']);
            return JsonResponse::successfulResponse('msg_updated_succssfully');
        } catch (\Exception $e) {
            return JsonResponse::errorResponse($e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Country $country
     * @return \Illuminate\Http\Response
     */
    public function destroy(Country $country)
    {
        try {
            $this->countryRepository->delete($country['id']);
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
    public function countryCities(Country $country)
    {
        try {
            return JsonResponse::successfulResponse('', CityResource::collection($country->cities));
        } catch (\Exception $e) {
            return JsonResponse::errorResponse($e->getMessage());
        }
    }
}
