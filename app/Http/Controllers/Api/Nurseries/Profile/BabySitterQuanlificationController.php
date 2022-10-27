<?php

namespace App\Http\Controllers\Api\Nurseries\Profile;

use App\Helpers\JsonResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Nurseries\BabysitterInfoRequest;
use App\Http\Requests\Api\Nurseries\BabysitterQulificationRequest;
use App\Http\Requests\Api\Nurseries\NurseryRequest;
use App\Http\Resources\Api\Nurseries\BabysitterInfoResource;
use App\Http\Resources\Api\Nurseries\BabysitterQulificationResource;
use App\Http\Resources\Api\Nurseries\NurseryResource;
use App\Http\Resources\Api\Nurseries\Profile\BabysitterQualificationResource;
use App\Models\Api\Generals\Qualification;
use App\Models\Api\Nurseries\BabysitterInfo;
use App\Models\Api\Nurseries\BabysitterQualification;
use App\Models\Api\Nurseries\Nursery;
use App\Repositories\Interfaces\Api\Nurseries\INurseryRepository;
use App\Repositories\Interfaces\Api\Nurseries\Profile\IBabysitterQualificationRepository;
use App\Repositories\Interfaces\Api\Nurseries\Profile\IBabysitterQulificationRepository;
use App\Repositories\Interfaces\Api\Nurseries\Profile\IBabySitterRepository;

class BabySitterQuanlificationController extends Controller
{

    private $babySitterRepository;

    public function __construct(IBabysitterQulificationRepository $babySitterRepository)
    {
        $this->babySitterRepository = $babySitterRepository;
    }

    public function index()
    {
        try {
            $nursery = Nursery::where('user_id', auth('api')->user()->id)->first();
            if ($nursery) {
                $nursery_id = $nursery->id;
                $babySitter = BabysitterInfo::find($nursery_id);
                if ($babySitter) {
                    return JsonResponse::successfulResponse('', BabysitterQualificationResource::collection($this->babySitterRepository->babySitterQualifications($babySitter->id)));
                }
            } else {
                return JsonResponse::errorResponse('');
            }
        } catch (\Exception $e) {
            return JsonResponse::errorResponse($e->getMessage());
        }
    }

    public function store(BabysitterQulificationRequest $request)
    {
        $data = $request->validated();
        $nursery = Nursery::where('user_id', auth('api')->user()->id)->first();
        if ($nursery) {
            $nursery_id = $nursery->id;
            $babySitter = BabysitterInfo::find($nursery_id);
            if ($babySitter) {
                $data['babysitter_id'] = $babySitter->id;
                return JsonResponse::successfulResponse('msg_created_succssfully', $this->babySitterRepository->create($data));
            }
        }
        return JsonResponse::errorResponse('');
    }

    public function update(BabysitterQulificationRequest $request,$id)
    {
        try {
            $babysitterQualification = BabysitterQualification::findOrFail($id);
            $nursery = Nursery::where('user_id', auth('api')->user()->id)->first();
            if ($nursery) {
                $nursery_id = $nursery->id;
                $babySitter = BabysitterInfo::find($nursery_id);
                if ($babySitter->id == $babysitterQualification->babysitter_id) {
                    $this->babySitterRepository->update($request->validated(), $babysitterQualification['id']);
                    return JsonResponse::successfulResponse('msg_updated_succssfully');
                }
            }
        } catch
        (\Exception $e) {
            return JsonResponse::errorResponse($e->getMessage());
        }
        return JsonResponse::errorResponse('edededed');

    }


    public function destroy($id)
    {
        try {
            $babysitterQualification = BabysitterQualification::findOrFail($id);
            $nursery = Nursery::where('user_id', auth('api')->user()->id)->first();
            if ($nursery) {
                $nursery_id = $nursery->id;
                $babySitter = BabysitterInfo::find($nursery_id);
                if ($babySitter->id == $babysitterQualification->babysitter_id) {
                    $this->babySitterRepository->delete($babysitterQualification['id']);
                    return JsonResponse::successfulResponse('msg_deleted_succssfully');
                }
            }
        } catch
        (\Exception $e) {
            return JsonResponse::errorResponse($e->getMessage());
        }
        return JsonResponse::errorResponse('');

    }

}
