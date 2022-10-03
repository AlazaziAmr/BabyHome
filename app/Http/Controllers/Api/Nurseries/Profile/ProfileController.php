<?php

namespace App\Http\Controllers\Api\Nurseries\Profile;

use App\Helpers\JsonResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Nurseries\NurseryRequest;
use App\Http\Resources\Api\Generals\AmenityResource;
use App\Http\Resources\Api\Nurseries\BabysitterInfoResource;
use App\Http\Resources\Api\Nurseries\BabysitterQulificationResource;
use App\Http\Resources\Api\Nurseries\NurseryResource;
use App\Http\Resources\Api\Nurseries\Profile\NurseryAmenityResource;
use App\Http\Resources\Api\Nurseries\Profile\SkillResource;
use App\Models\Api\Nurseries\Nursery;
use App\Repositories\Interfaces\Api\Nurseries\INurseryRepository;

class ProfileController extends Controller
{
    private $nurseryRepository;

    public function __construct(INurseryRepository $nurseryRepository)
    {
        $this->nurseryRepository = $nurseryRepository;
    }

    public function profile()
    {
        try {
            if (user()->id == 0) {
                return JsonResponse::errorResponse('');
            }
            $data['nursery'] = array();
            $data['babysitter'] = array();
//            $data['qualifications'] = array();
//            $data['skills'] = array();

            $data['nursery'] = new NurseryResource($this->nurseryRepository->FindOne(['country', 'city', 'neighborhood','utilities']));
            if ($data['nursery']) {
                $data['babysitter'] = new BabysitterInfoResource($this->nurseryRepository->BabySitter($data['nursery']->id));
                $data['amenities'] = NurseryAmenityResource::collection($this->nurseryRepository->NurseryAmenity($data['nursery']->id));
                if ($data['babysitter']) {
//                    $data['skills'] = SkillResource::collection($this->nurseryRepository->skills($data['babysitter']->id));
//                    $data['qualifications'] = new BabysitterQulificationResource($this->nurseryRepository->qualifications(6));
                }

            }

            return JsonResponse::successfulResponse('msg_success', $data);
        } catch (\Exception $e) {
            return JsonResponse::errorResponse($e->getMessage());
        }
    }

    public function babySitterInfo()
    {
        try {
            if (user()->id == 0) {
                return JsonResponse::errorResponse('');
            }
            $data['nursery'] = array();
            $data['babysitter'] = array();
            $data['qualifications'] = array();
            $data['nursery'] = new NurseryResource($this->nurseryRepository->FindOne(['country', 'city', 'neighborhood','utilities']));
            if ($data['nursery']) {
                $data['babysitter'] = new BabysitterInfoResource($this->nurseryRepository->BabySitter($data['nursery']->id));
                $data['amenities'] = NurseryAmenityResource::collection($this->nurseryRepository->NurseryAmenity($data['nursery']->id));
                if ($data['babysitter']) {
                    $data['skills'] = SkillResource::collection($this->nurseryRepository->skills($data['babysitter']->id));
                    $data['qualifications'] = new BabysitterQulificationResource($this->nurseryRepository->qualifications($data['babysitter']->id));
                }

            }

            return JsonResponse::successfulResponse('msg_success', $data);
        } catch (\Exception $e) {
            return JsonResponse::errorResponse($e->getMessage());
        }
    }


    public function skills()
    {

    }

    public function utilities()
    {

    }

    public function amenities($id)
    {
        try {
            return JsonResponse::successfulResponse('', NurseryAmenityResource::collection($this->nurseryRepository->NurseryAmenity($id)));
        } catch (\Exception $e) {
            return JsonResponse::errorResponse($e->getMessage());
        }
    }

    public function services()
    {

    }

    public function nursery(NurseryRequest $request)
    {
        try {
            $nurseries = Nursery::findorFail(1);
            $this->nurseryRepository->update($request->validated(), $nurseries['id']);
            return JsonResponse::successfulResponse('msg_updated_succssfully');
        } catch (\Exception $e) {
            return JsonResponse::errorResponse($e->getMessage());
        }
    }

}
