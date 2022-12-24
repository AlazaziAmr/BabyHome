<?php

namespace App\Http\Controllers\Api\Nurseries;

use App\Helpers\JsonResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Nurseries\LicenseRequest;
use App\Http\Resources\Api\Nurseries\LicenseResource;
use App\Models\Api\Nurseries\Nursery;
use App\Repositories\Interfaces\Api\Nurseries\INurseryRepository;
use Illuminate\Http\Request;

class LicenseController extends Controller
{
    private $nurseryRepository;

    public function __construct(INurseryRepository $nurseryRepository)
    {
        $this->nurseryRepository = $nurseryRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        //

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(LicenseRequest $request)
    {
        //
        try {
            $this->nurseryRepository->addLicense($request->validated(),$request->nursery_id);
            return JsonResponse::successfulResponse('msg_added_successfully');
        } catch (\Exception $e) {
            return JsonResponse::errorResponse($e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        //
        try {
            $nursery = Nursery::findOrFail($id);
            $data = $this->nurseryRepository->FindOne('attachmentable',$nursery->user_id);
            return JsonResponse::successfulResponse('msg_success', LicenseResource::make($data));
        } catch (\Exception $e) {
            return JsonResponse::errorResponse($e->getMessage());
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
