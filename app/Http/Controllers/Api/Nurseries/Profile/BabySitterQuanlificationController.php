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
use App\Models\Api\Nurseries\BabysitterInfo;
use App\Models\Api\Nurseries\BabysitterQualification;
use App\Models\Api\Nurseries\Nursery;
use App\Repositories\Interfaces\Api\Nurseries\INurseryRepository;
use App\Repositories\Interfaces\Api\Nurseries\Profile\IBabysitterQualificationRepository;
use App\Repositories\Interfaces\Api\Nurseries\Profile\IBabySitterRepository;

class BabySitterQuanlificationController extends Controller
{
   private $babySitterRepository;

//    public function __construct(IBabysitterQualificationRepository $babySitterRepository)
//    {
//        $this->babySitterRepository = $babySitterRepository;
//    }

    public function index()
    {
        try {
            $nursery =Nursery::where('user_id',auth('api')->user()->id)->first();
            if($nursery){
                $nursery_id = $nursery->id;
                $baby = BabysitterInfo::find($nursery_id);
                $nurseries = BabysitterQualification::with('qualification')->where('babysitter_id',$baby->id)->get();
                return JsonResponse::successfulResponse('msg_success', $nurseries);
            }else{
                return JsonResponse::errorResponse('');
            }
           } catch (\Exception $e) {
            return JsonResponse::errorResponse($e->getMessage());
        }
    }

    public function store(BabysitterQulificationRequest $request){
        try {
            $nursery =Nursery::where('user_id',auth('api')->user()->id)->first();
            if($nursery){
                $nursery_id = $nursery->id;
                $babySitter = BabysitterInfo::find($nursery_id);
                if($babySitter){
                    $data = $request->validated();
                    $data['babysitter_id'] = $babySitter->id;
                    $this->babySitterRepository->create($data);
                }
                return JsonResponse::successfulResponse('msg_updated_succssfully');
            }else{
                return JsonResponse::errorResponse('');
            }
        } catch (\Exception $e) {
            return JsonResponse::errorResponse($e->getMessage());
        }
    }

}
