<?php

namespace App\Http\Controllers\Admin\Inspections;

use App\DataTables\Admin\Nursery\InspectionDataTable;
use App\Models\Api\Admin\Inspections\InspectionResult;
use App\Models\Api\Admin\Inspections\InspectionResultDetail;
use App\Models\Api\Nurseries\BabysitterInfo;
use App\Models\Api\Nurseries\BabysitterQualification;
use App\Models\Api\Nurseries\BabysitterSkill;
use App\Models\Api\Nurseries\NurseryAmenity;
use App\Models\Api\Nurseries\NurseryService;
use App\Models\Api\Nurseries\NurseryUtility;
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
    public function index(InspectionDataTable $dataTable)
    {
        $data['title'] = __('site.inspections');
        $data['inspections'] = Inspection::with(['nursery.owner'])
//            ->where('inspector_id ',auth()->guard('dashboard')->user()->id)
            ->get();
        return view('dashboard.nurseries.inspections.index', compact('data'));

    }

    public function store(Request $request)
    {
        return response()->json(array('success' => true), 200);

        $ins = Inspection::findOrFail($request->id);
        $lat = 0;
        $lng = 0;

        try {
            $new_arr[] = unserialize(file_get_contents('http://www.geoplugin.net/php.gp?ip=' . $_SERVER['REMOTE_ADDR']));
            $lat = $new_arr[0]['geoplugin_latitude'];
            $lng = $new_arr[0]['geoplugin_longitude'];
        } catch (\Exception $ex) {

        }

        $result = InspectionResult::create([
            'inspection_id' => $ins->id,
            'latitude' => ($lat) ? $lat : 0,
            'longitude' => ($lng) ? $lng : 0,
        ]);

        InspectionResultDetail::create([
            'inspection_result_id' => $result->id,
            'criteria' => 0,
            'rating' => $request->general_amenity,
            'matching' => $request->match_amenity,
            'recommendation' => $request->recommend_amenity,
            'comment' => $request->comment_amenity
        ]);

        InspectionResultDetail::create([
            'inspection_result_id' => $result->id,
            'criteria' => 1,
            'rating' => $request->general_babysitter,
            'matching' => $request->match_babysitter,
            'recommendation' => $request->recommend_babysitter,
            'comment' => $request->comment_babysitter
        ]);


        InspectionResultDetail::create([
            'inspection_result_id' => $result->id,
            'criteria' => 2,
            'rating' => $request->general_nursery,
            'matching' => $request->match_nursery,
            'recommendation' => $request->recommend_nursery,
            'comment' => $request->comment_nursery
        ]);

        $data3 = [
            'inspection_result_id' => $result->id,
            'criteria' => 3,
            'rating' => $request->general_utility,
            'matching' => $request->match_utility,
            'recommendation' => $request->recommend_utility,
            'comment' => $request->comment_utility
        ];
        InspectionResultDetail::create($data3);

        InspectionResultDetail::create([
            'inspection_result_id' => $result->id,
            'criteria' => 4,
            'rating' => $request->general_service,
            'matching' => $request->match_service,
            'recommendation' => $request->recommend_service,
            'comment' => $request->comment_service
        ]);
        if (!empty($result['attachments'])) uploadAttachment($result, $ins, 'attachments', 'inspections-results');

//        image_
        return response()->json(array('success' => true), 200);
    }

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
    public function show($id)
    {
        $ins = Inspection::findOrFail($id);
        $data['title'] = __('site.inspections');
        $data['nursery'] = Nursery::with(['country:id,name', 'city:id,name', 'neighborhood:id,name', 'owner:id,name,phone'])->findOrFail($ins->nursery_id);
        $data['babysitter'] = BabysitterInfo::with(['languages', 'nationalitydata', 'attachmentable'])
            ->where('nursery_id', $ins->nursery_id)
            ->first();
        $data['ins'] = $ins;
        $data['amenities'] = NurseryAmenity::with(['amenity', 'attachmentable'])
            ->where('nursery_id', $ins->nursery_id)
            ->get();

        $data['utilities'] = NurseryUtility::with(['utility'])->where('nursery_id', $ins->nursery_id)
            ->get();

        $data['services'] = NurseryService::with(['service.attachmentable'])->where('nursery_id', $ins->nursery_id)
            ->get();

        if ($data['babysitter']) {
            $data['skills'] = BabysitterSkill::where('babysitter_id', $data['babysitter']->id)
                ->get();
            $data['qualifications'] = BabysitterQualification::with(['qualification'])
                ->where('babysitter_id', $data['babysitter']->id)
                ->get();
        }

        $result = InspectionResult::with(['details','attachmentable','inspector'])->where('inspection_id', $id)->first();
//        if ($result)
//            return view('dashboard.nurseries.inspections.result', compact('data','result'));
//        else
            return view('dashboard.nurseries.inspections.show', compact('data'));

    }
}
