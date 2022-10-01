<?php

namespace App\Http\Controllers\Api\Generals;

use App\Helpers\JsonResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Generals\NationalityRequest;
use App\Http\Resources\Api\Generals\NationalityResource;
use App\Models\Api\Generals\Nationality;
use App\Repositories\Interfaces\Api\Generals\INationalityRepository;
use Illuminate\Http\Request;

class NationalityController extends Controller
{
    private $nationalityRepository;

    public function __construct(INationalityRepository $nationalityRepository)
    {
        $this->nationalityRepository = $nationalityRepository;
    }

    public function index()
    {
        try {
            app()->setLocale('ar');
            return JsonResponse::successfulResponse('', NationalityResource::collection($this->nationalityRepository->fetchAll()));
        } catch (\Exception $e) {
            return JsonResponse::errorResponse($e->getMessage());
        }
    }

    public function store(NationalityRequest $request)
    {
        return JsonResponse::successfulResponse('msg_created_succssfully', $this->nationalityRepository->create($request->validated()));
    }

    public function show(Nationality $nationality)
    {
        try {
            $nationality = new NationalityResource($nationality);
            return JsonResponse::successfulResponse('msg_success', $nationality);
        } catch (\Exception $e) {
            return JsonResponse::errorResponse($e->getMessage());
        }
    }

    public function update(NationalityRequest $request, Nationality $nationality)
    {
        try {
            $this->nationalityRepository->update($request->validated(), $nationality['id']);
            return JsonResponse::successfulResponse('msg_updated_succssfully');
        } catch (\Exception $e) {
            return JsonResponse::errorResponse($e->getMessage());
        }
    }

    public function destroy(Nationality $nationality)
    {
        try {
            $this->nationalityRepository->delete($nationality['id']);
            return JsonResponse::successfulResponse('msg_deleted_succssfully');
        } catch (\Exception $e) {
            return JsonResponse::errorResponse($e->getMessage());
        }
    }

}
