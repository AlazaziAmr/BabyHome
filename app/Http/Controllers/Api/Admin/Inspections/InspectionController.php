<?php

namespace App\Http\Controllers\Api\Admin\Inspections;

use Illuminate\Http\Request;
use App\Helpers\JsonResponse;
use App\Http\Controllers\Controller;
use App\Models\Api\Nurseries\Nursery;
use App\Models\Api\Admin\Inspections\Inspection;
use App\Repositories\Interfaces\Api\Admin\IInspectionRepository;
use App\Repositories\Interfaces\Api\Nurseries\INurseryRepository;
use App\Http\Resources\Api\Admin\Inspections\AdminInspectionResource;
use App\Http\Requests\Api\Admin\Inspections\AdminInspectionResultRequest;
use App\Http\Resources\Api\Admin\Inspections\AdminInspectionResultArrayResource;
use App\Http\Resources\Api\Admin\Inspections\AdminInspectionResultResource;

class InspectionController extends Controller
{
    private $inspectionRepository;
    private $iNurseryRepository;

    public function __construct(IInspectionRepository $inspectionRepository, INurseryRepository $iNurseryRepository)
    {
        $this->inspectionRepository = $inspectionRepository;
        $this->iNurseryRepository = $iNurseryRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            return JsonResponse::successfulResponse('', AdminInspectionResource::collection($this->inspectionRepository->fetchAllForAuthAdmin()));
        } catch (\Exception $e) {
            return JsonResponse::errorResponse($e->getMessage());
        }
    }
    /**
     * activate the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function statusUpdate(Request $request)
    {
        try {
            if ($this->inspectionRepository->findBy('id', $request['id'])['status'] == 'assigned') {
                $this->inspectionRepository->update(['status' => 1], $request['id']);
                $this->iNurseryRepository->update(['status' => 2], $request['nursery']);
                return JsonResponse::successfulResponse('msg_status_updated');
            }
        } catch (\Exception $e) {
            return JsonResponse::errorResponse($e->getMessage());
        }
    }

    /**
     * activate the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function submitResult(AdminInspectionResultRequest $request)
    {
        try {
            if ($this->inspectionRepository->submitResult($request->validated())) {
                $this->iNurseryRepository->update(['status' => 3], $request['nursery_id']);
                $this->inspectionRepository->update(['status' => 3], $request['inspection_id']);
                return JsonResponse::successfulResponse('msg_result_submited_successfully');
            }
            return JsonResponse::errorResponse('msg_submit_failed');
            // return $this->inspectionRepository->submitResult($request->validated()) ? JsonResponse::successfulResponse('Result_Submited_Successfully') : JsonResponse::errorResponse('msg_submit_failed');
        } catch (\Exception $e) {
            return JsonResponse::errorResponse($e->getMessage());
        }
    }
    /**
     * Display a result.
     *
     * @return \Illuminate\Http\Response
     */
    public function showResult(Request $request)
    {
        try {
            return JsonResponse::successfulResponse('', new  AdminInspectionResultArrayResource($this->inspectionRepository->getResult($request)));
        } catch (\Exception $e) {
            return JsonResponse::errorResponse($e->getMessage());
        }
    }
}
