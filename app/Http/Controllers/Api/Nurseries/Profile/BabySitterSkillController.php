<?php

namespace App\Http\Controllers\Api\Nurseries\Profile;

use App\Helpers\JsonResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Nurseries\BabysitterInfoRequest;
use App\Http\Requests\Api\Nurseries\BabysitterSkillRequest;
use App\Http\Requests\Api\Nurseries\NurseryRequest;
use App\Http\Resources\Api\Nurseries\BabysitterInfoResource;
use App\Http\Resources\Api\Nurseries\BabysitterSkillResource;
use App\Http\Resources\Api\Nurseries\NurseryResource;
use App\Models\Api\Nurseries\BabysitterInfo;
use App\Models\Api\Nurseries\BabysitterSkill;
use App\Models\Api\Nurseries\Nursery;
use App\Repositories\Interfaces\Api\Nurseries\INurseryRepository;
use App\Repositories\Interfaces\Api\Nurseries\Profile\IBabySitterRepository;
use App\Repositories\Interfaces\Api\Nurseries\Profile\IBabySitterSkillsRepository;

class BabySitterSkillController extends Controller
{
    private $babySitterRepository;

    public function __construct(IBabySitterSkillsRepository $babySitterRepository)
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
                    return JsonResponse::successfulResponse('', BabysitterSkillResource::collection($this->babySitterRepository->babySitterSkills($babySitter->id)));
                }
            } else {
                return JsonResponse::errorResponse('');
            }
        } catch (\Exception $e) {
            return JsonResponse::errorResponse($e->getMessage());
        }
    }

    public function store(BabysitterSkillRequest $request)
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

    public function update(BabysitterSkillRequest $request,$id)
    {
        try {
            $babysitterSkill = BabysitterSkill::findOrFail($id);
            $nursery = Nursery::where('user_id', auth('api')->user()->id)->first();
            if ($nursery) {
                $nursery_id = $nursery->id;
                $babySitter = BabysitterInfo::find($nursery_id);
                if ($babySitter->id == $babysitterSkill->babysitter_id) {
                    $this->babySitterRepository->update($request->validated(), $babysitterSkill['id']);
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
            $babysitterSkill = BabysitterSkill::findOrFail($id);
            $nursery = Nursery::where('user_id', auth('api')->user()->id)->first();
            if ($nursery) {
                $nursery_id = $nursery->id;
                $babySitter = BabysitterInfo::find($nursery_id);
                if ($babySitter->id == $babysitterSkill->babysitter_id) {
                    $this->babySitterRepository->delete($babysitterSkill['id']);
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
