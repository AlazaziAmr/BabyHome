<?php

namespace App\Http\Controllers\Api\Generals;

use App\Helpers\JsonResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Generals\LanguageRequest;
use App\Http\Resources\Api\Generals\LanguageResource;
use App\Models\Api\Generals\Language;
use App\Repositories\Interfaces\Api\Generals\ILanguageRepository;

class LanguageController extends Controller
{
    private $languageRepository;

    public function __construct(ILanguageRepository $languageRepository)
    {
        $this->languageRepository = $languageRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            return JsonResponse::successfulResponse('', LanguageResource::collection($this->languageRepository->fetchAll()));
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
    public function store(LanguageRequest $request)
    {
        return JsonResponse::successfulResponse('msg_created_succssfully', $this->languageRepository->create($request->validated()));
    }

    /**
     * Display the specified resource.
     *
     * @param  Language $language
     * @return \Illuminate\Http\Response
     */
    public function show(Language $language)
    {
        try {
            $language = new LanguageResource($language);
            return JsonResponse::successfulResponse('msg_success', $language);
        } catch (\Exception $e) {
            return JsonResponse::errorResponse($e->getMessage());
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Language $language
     * @return \Illuminate\Http\Response
     */
    public function update(LanguageRequest $request, Language $language)
    {
        try {
            $this->languageRepository->update($request->validated(), $language['id']);
            return JsonResponse::successfulResponse('msg_updated_succssfully');
        } catch (\Exception $e) {
            return JsonResponse::errorResponse($e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Language $language
     * @return \Illuminate\Http\Response
     */
    public function destroy(Language $language)
    {
        try {
            $this->languageRepository->delete($language['id']);
            return JsonResponse::successfulResponse('msg_deleted_succssfully');
        } catch (\Exception $e) {
            return JsonResponse::errorResponse($e->getMessage());
        }
    }
}
