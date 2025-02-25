<?php

namespace App\Http\Controllers\Api\Nurseries\Profile;

use App\Helpers\JsonResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Nurseries\NurseryRequest;
use App\Http\Resources\Api\Generals\ActivityResource;
use App\Http\Resources\Api\Generals\AmenityResource;
use App\Http\Resources\Api\Nurseries\BabysitterInfoResource;
use App\Http\Resources\Api\Nurseries\BabysitterQulificationResource;
use App\Http\Resources\Api\Nurseries\NurseryResource;
use App\Http\Resources\Api\Nurseries\Profile\NurseryAmenityResource;
use App\Http\Resources\Api\Nurseries\Profile\BabySitterSkillResource;
use App\Http\Resources\Api\Nurseries\Profile\NurseryServiceResource;
use App\Http\Resources\Api\Users\UserResource;
use App\Models\Api\Generals\Amenity;
use App\Models\Api\Nurseries\Nursery;
use App\Models\User;
use App\Repositories\Interfaces\Api\Nurseries\INurseryRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

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
            $data['qualifications'] = array();
            $data['skills'] = array();
            $data['amenities'] = array();
            $data['activities'] = array();
            $data['services'] = array();


            $nursery = $this->nurseryRepository->FindOne(['country', 'city', 'neighborhood', 'utilities', 'activities']);
            if ($nursery) {
                $data['nursery'] = new NurseryResource($nursery);
            }
            if ($data['nursery']) {
                $babysitter = $this->nurseryRepository->BabySitter($data['nursery']->id);
                if ($babysitter) {
                    $data['babysitter'] = new BabysitterInfoResource($babysitter);
                }
                $data['services'] = NurseryServiceResource::collection($this->nurseryRepository->NurseryService($data['nursery']->id));
                $data['activities'] = ActivityResource::collection($data['nursery']->customerActivities());
                $amenities = $this->nurseryRepository->NurseryAmenity($data['nursery']->id);
                if ($amenities) {
                    $data['amenities'] = NurseryAmenityResource::collection($amenities);
                }
                if ($data['babysitter']) {
                    $skills = $this->nurseryRepository->skills($data['babysitter']->id);
                    if ($skills) {
                        $data['skills'] = BabySitterSkillResource::collection($skills);
                    }
                    $qualifications = $this->nurseryRepository->qualifications($data['babysitter']->id);
                    if ($qualifications) {
                        $data['qualifications'] = BabysitterQulificationResource::collection($qualifications);
                    }
                }

            }

            return JsonResponse::successfulResponse('msg_success', $data);
        } catch (\Exception $e) {
            return JsonResponse::errorResponse($e->getMessage());
        }
    }

    public function nursery_profile($id)
    {
        try {
            User::findOrFail($id);
            $data['nursery'] = null;
            $data['babysitter'] = null;
            $data['qualifications'] = null;
            $data['skills'] = null;
            $data['amenities'] = null;
            $data['activities'] = null;
            $data['services'] = null;

            $nursery = $this->nurseryRepository->FindOne(['country', 'city', 'neighborhood', 'utilities', 'activities', 'owner'], $id);
            if ($nursery) {
                $data['nursery'] = new NurseryResource($nursery);
            }
            if ($data['nursery']) {
                $babysitter = $this->nurseryRepository->BabySitter($data['nursery']->id);
                if ($babysitter) {
                    $data['babysitter'] = new BabysitterInfoResource($babysitter);
                }
                $data['services'] = NurseryServiceResource::collection($this->nurseryRepository->NurseryService($data['nursery']->id));
                $data['activities'] = ActivityResource::collection($data['nursery']->customerActivities());
                $amenities = $this->nurseryRepository->NurseryAmenity($data['nursery']->id);
                if ($amenities) {
                    $data['amenities'] = NurseryAmenityResource::collection($amenities);
                }

                if ($data['babysitter']) {
                    $skills = $this->nurseryRepository->skills($data['babysitter']->id);
                    if ($skills) {
                        $data['skills'] = BabySitterSkillResource::collection($skills);
                    }
                    $qualifications = $this->nurseryRepository->qualifications($data['babysitter']->id);
                    if ($qualifications) {
                        $data['qualifications'] = BabysitterQulificationResource::collection($qualifications);
                    }
                }
            }
            return JsonResponse::successfulResponse('msg_success', $data);
        } catch (\Exception $e) {
            return JsonResponse::errorResponse($e->getMessage());
        }
    }

    public function userProfile($id)
    {
        try {
            $user = User::findOrFail($id);
            if ($user) {
                return JsonResponse::successfulResponse('msg_success', new UserResource($user));
            }
        } catch (\Exception $e) {
            return JsonResponse::errorResponse($e->getMessage());
        }
    }

    public function addEmail(Request $request)
    {
        Validator::make($request->all(), [
            'user_id' => 'required|numeric',
            'email' => 'required|string|email|max:191',
        ]);

        try {
            $user = User::findOrFail($request->user_id);
            if ($user) {
                $checkEmail = User::where('email', $request->email)->whereNotNull('email_verified_at')->get();
                if ($checkEmail->count() > 0) {
                    return JsonResponse::errorResponse('email_taken');
                }
                $user->email = $request->email;
                $user->activation_code = OTPGenrator();
                $user->save();
                $user->sendEmailVerificationNotification();
                return JsonResponse::successfulResponse('msg_added_successfully_with_code', $user);
            }
        } catch (\Exception $e) {
            return JsonResponse::errorResponse($e->getMessage());
        }
    }

    public function updateEmail(Request $request)
    {
        Validator::make($request->all(), [
            'user_id' => 'required|numeric',
            'email' => 'required|string|email|max:191',
        ]);

        try {
            $user = User::findOrFail($request->user_id);
            if ($user) {
                $checkEmail = User::where('email', $request->email)->whereNotNull('email_verified_at')->get();
                if ($checkEmail->count() > 0) {
                    return JsonResponse::errorResponse('email_taken');
                }
                $user->email = $request->email;
                $user->activation_code = OTPGenrator();
                $user->save();
                $user->sendEmailVerificationNotification();
                return JsonResponse::successfulResponse('msg_updated_successfully_with_code', $user);
            }
        } catch (\Exception $e) {
            return JsonResponse::errorResponse($e->getMessage());
        }
    }

    public function verifyEmail(Request $request)
    {
        try {
            $user = User::where('email', $request['email'])->where([
                'email_verified_at' => null,
                'activation_code' => $request['activation_code'],
            ])->first();
            if ($user) {
                $user->email_verified_at = now();
                $user->save();
                return JsonResponse::successfulResponse('msg_verified_successfully');
            } else {
                return JsonResponse::errorResponse('email_not_registered_or_invalid_code');
            }
        } catch (\Exception $e) {
            return JsonResponse::errorResponse($e->getMessage());
        }
    }

    public function updatePhone(Request $request)
    {
        try {
            $user = User::findOrFail($request->user_id);
            if ($user) {
                $checkPhone = User::where('phone', $request->phone)->where('is_verified', 1)->get();
                if ($checkPhone->count() > 0) {
                    return JsonResponse::errorResponse('هذا الرقم مستخدم.');
                }
                $OTP = OTPGenrator();
                $user->phone = $request->phone;
                $user->activation_code = $OTP;
                $user->save();
                sendOTP($OTP, $user->phone, '');
                return JsonResponse::successfulResponse('msg_updated_successfully_with_code', $user);
            }
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
            $data['nursery'] = new NurseryResource($this->nurseryRepository->FindOne(['country', 'city', 'neighborhood', 'utilities']));
            if ($data['nursery']) {
                $data['babysitter'] = new BabysitterInfoResource($this->nurseryRepository->BabySitter($data['nursery']->id));
                $data['amenities'] = NurseryAmenityResource::collection($this->nurseryRepository->NurseryAmenity($data['nursery']->id));
                $data['services'] = NurseryServiceResource::collection($this->nurseryRepository->NurseryService($data['nursery']->id));
                if ($data['babysitter']) {
                    $data['skills'] = BabySitterSkillResource::collection($this->nurseryRepository->skills($data['babysitter']->id));
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
