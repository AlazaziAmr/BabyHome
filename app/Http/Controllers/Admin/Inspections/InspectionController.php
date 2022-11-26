<?php

namespace App\Http\Controllers\Admin\Inspections;

use App\DataTables\Admin\Nursery\InspectionDataTable;
use App\Models\AdminNotification;
use App\Models\Api\Admin\Admin;
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
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

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
            ->where('inspector_id', auth()->guard('admin')->user()->id)
            ->get();
        return view('dashboard.nurseries.inspections.index', compact('data'));

    }

    public function store(Request $request)
    {
        $rules = [
//            'general_amenity' => 'required|integer',
            'match_amenity' => 'required|integer',
//            'recommend_amenity' => 'required|integer',
            'comment_amenity' => 'required|string',
//            'general_babysitter' => 'required|integer',
            'match_babysitter' => 'required|integer',
//            'recommend_babysitter' => 'required|integer',
            'comment_babysitter' => 'required|string',
//            'general_nursery' => 'required|integer',
            'match_nursery' => 'required|integer',
//            'recommend_nursery' => 'required|integer',
            'comment_nursery' => 'required|string',
//            'general_utility' => 'required|integer',
            'match_utility' => 'required|integer',
//            'recommend_utility' => 'required|integer',
            'comment_utility' => 'required|string',
//            'general_service' => 'required|integer',
            'match_service' => 'required|integer',
//            'recommend_service' => 'required|integer',
            'comment_service' => 'required|string',
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json(array(
                'success' => false,
                'errors' => $validator->getMessageBag()->toArray()

            ), 200);
        } else {
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
                'criteria' => 'amenities',
                'rating' => 0,
                'matching' => $request->match_amenity,
                'recommendation' => 0,
                'comment' => $request->comment_amenity
            ]);

            InspectionResultDetail::create([
                'inspection_result_id' => $result->id,
                'criteria' => 'babySetter',
                'rating' => 0,
                'matching' => $request->match_babysitter,
                'recommendation' => 0,
                'comment' => $request->comment_babysitter
            ]);


            InspectionResultDetail::create([
                'inspection_result_id' => $result->id,
                'criteria' => 'nurseryInfo',
                'rating' => 0,
                'matching' => $request->match_nursery,
                'recommendation' => 0,
                'comment' => $request->comment_nursery
            ]);

            InspectionResultDetail::create([
                'inspection_result_id' => $result->id,
                'criteria' => 'utilities',
                'rating' => 0,
                'matching' => $request->match_utility,
                'recommendation' => 0,
                'comment' => $request->comment_utility
            ]);

            InspectionResultDetail::create([
                'inspection_result_id' => $result->id,
                'criteria' => 'services',
                'rating' => 0,
                'matching' => $request->match_service,
                'recommendation' => 0,
                'comment' => $request->comment_service
            ]);
            if (!empty($result['attachments'])) uploadAttachment($result, $ins, 'attachments', 'inspections-results');

            $this->iNurseryRepository->update(['status' => 3], $ins->nursery_id);
            $this->inspectionRepository->update(['status' => 3], $ins->id);

            $admin = Admin::find($ins->inspector_id);
            $nursery = Nursery::with('owner')->find($ins->nursery_id);
            $name = ($nursery->owner) ? $nursery->owner->name  :'';
            AdminNotification::create([
                'notifiable_type' => 'App\Models\Api\Admin\Admin',
                'notifiable_id' => 0,
                'title' => 'تفتيش الحاضنه',
                'description' =>
                    ' ( '.$name.' بتفتيش الحاضنه ( '.$admin->name.' لقد قام ',
                'link' => route('__bh_.inspections.show',$ins->id),
                'mark_as_read' => 0,
                'type' => 1,
            ]);



            return response()->json(array('success' => true), 200);
        }
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
        $data['nursery'] = Nursery::with(['country:id,name', 'city:id,name', 'neighborhood:id,name', 'owner:id,name,phone', 'attachmentable'])->findOrFail($ins->nursery_id);
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


        $result = InspectionResult::with(['details', 'attachmentable', 'inspector'])->where('inspection_id', $id)->first();
        if ($result)
            return view('dashboard.nurseries.inspections.result', compact('data', 'result'));
        else
            return view('dashboard.nurseries.inspections.show', compact('data'));

    }
}
