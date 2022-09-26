<?php

namespace App\Http\Controllers\Api\Generals;

use App\Helpers\JsonResponse;
use App\Http\Controllers\Controller;
use App\Http\Resources\Api\Generals\DayResource;
use App\Repositories\Interfaces\Api\Generals\IDayRepository;

class DayController extends Controller

{
    private $dayRepository;

    public function __construct(IDayRepository $dayRepository)
    {
        $this->dayRepository = $dayRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            return JsonResponse::successfulResponse('', DayResource::collection($this->dayRepository->fetchAll()));
        } catch (\Exception $e) {
            return JsonResponse::errorResponse($e->getMessage());
        }
    }
}
