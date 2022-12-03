<?php

namespace App\Http\Controllers\Api\Generals;

use App\Helpers\JsonResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Generals\ActivityRequest;
use App\Http\Resources\Api\Generals\ActivityResource;
use App\Models\Api\Generals\Activity;
use App\Models\Api\Generals\NurseryServiceType;
use App\Repositories\Interfaces\Api\Generals\IActivityRepository;

class ActivityController extends Controller
{
    private $activityRepository;

    public function __construct(IActivityRepository $activityRepository)
    {
        $this->activityRepository = $activityRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        try {
            $requestProcess=$this->activityRepository->index();
            if ($requestProcess==null){
                $msg='عذراَ لايوجد حجوزات لعرضها حالياَ';
                return $this->returnEmpty($msg);
            }else{
                $msg='تم إرجاع البيانات بنجاح';
                return $this->returnData($requestProcess,$msg);
            }
        }catch (\Exception $e) {
            return JsonResponse::errorResponse($e->getMessage());
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ActivityRequest $request)
    {

        return JsonResponse::successfulResponse('msg_created_succssfully', $this->activityRepository->createRequest($request->validated()));
    }

    /**
     * Display the specified resource.
     *
     * @param  Activity $activity
     * @return \Illuminate\Http\Response
     */
    public function show(Activity $activity)
    {
        try {
            $activity = new ActivityResource($activity);
            return JsonResponse::successfulResponse('msg_success', $activity);
        } catch (\Exception $e) {
            return JsonResponse::errorResponse($e->getMessage());
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Activity $activity
     * @return \Illuminate\Http\Response
     */
    public function update(ActivityRequest $request, Activity $activity)
    {
        try {
            $this->activityRepository->update($request->validated(), $activity['id']);
            return JsonResponse::successfulResponse('msg_updated_succssfully');
        } catch (\Exception $e) {
            return JsonResponse::errorResponse($e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Activity $activity
     * @return \Illuminate\Http\Response
     */
    public function destroy(Activity $activity)
    {
        try {
            $this->activityRepository->delete($activity['id']);
            return JsonResponse::successfulResponse('msg_deleted_succssfully');
        } catch (\Exception $e) {
            return JsonResponse::errorResponse($e->getMessage());
        }
    }
}
