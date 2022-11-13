<?php

namespace App\Http\Controllers\Api\Master\Auth;

use App\Helpers\JsonResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Master\Auth\MasterLoginRequest;
use App\Http\Requests\Api\Master\Auth\MasterRegistrationRequest;
use App\Http\Resources\Api\Master\Auth\MasterResource;
use App\Models\Api\Master\Master;
use App\Repositories\Interfaces\Api\Master\IMasterRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class MasterAuthController extends Controller
{
    private $masterRepository;

    public function __construct(IMasterRepository $masterRepository)
    {
        $this->masterRepository = $masterRepository;
    }


    public function VerfiedMasterWithToken($master)
    {
        config(['auth.guards.api.provider' => 'master']);

        $response = ['token' => $master->createToken('Baby Home Client', ['master'])->plainTextToken];
        return (new MasterResource($master))->additional(array_merge(['data' => $response], JsonResponse::success()));
    }
    public function masterWithToken($master)
    {
        config(['auth.guards.api.provider' => 'master']);

        $response = ['token' => $master->createToken('Baby Home Client', ['master'])->plainTextToken];
        return (new MasterResource($master))->additional(array_merge(['data' => $response], JsonResponse::sentSuccssfully()));
    }
    /**
     * Master registerion
     *
     * @param Request $request
     *
     * @return MasterResource
     */
    public function register(MasterRegistrationRequest $request)
    {
        try {
            $data = $request->validated();
            $data['activation_code'] = OTPGenrator();
            $master = $this->masterRepository->register($data);
             sendOTP($master['activation_code'], $master['phone'],$message = '');
            return $this->masterWithToken($master);
        } catch (\Exception $e) {
            return JsonResponse::errorResponse($e->getMessage());
        }
    }


    /**
     *master login
     *
     * @param Request $request
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function login(MasterLoginRequest $request)
    {
        try {
            $master =  $this->masterRepository->findBy('phone', $request['phone']);

            if ($master) {
                if (!$master['is_verified']) {
                    $OTP = OTPGenrator();
                    $master->update(['activation_code' => $OTP ]);
                     sendOTP($OTP, $request['phone'],$message = '');
                    if (Hash::check($request['password'], $master['password'])) {
                        return $this->masterWithToken($master);
                    } else {
                        return JsonResponse::errorResponse('msg_password_mismatch');
                    }
                }
                if (Hash::check($request['password'], $master['password'])) {
                    return $this->VerfiedMasterWithToken($master);
                } else {
                    return JsonResponse::errorResponse('msg_password_mismatch');
                }
            } else {
                return JsonResponse::errorResponse('msg_master_does_not_exist');
            }
        } catch (\Exception $e) {
            return JsonResponse::errorResponse($e->getMessage());
        }
    }

    /**
     *logout
     *
     * @param Request $request
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function logout()
    {
        try {
            master()->tokens()->delete();
            return JsonResponse::successfulResponse('msg_logged_out_succssfully');
        } catch (\Exception $e) {
            return JsonResponse::errorResponse($e->getMessage());
        }
    }



    /**
     *resend OTP
     *
     * @param Request $request
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function resendOTP(Request $request)
    {
        try {
            $master =  $this->masterRepository->findBy('phone', $request['phone']);
            if ($master) {
                $OTP = OTPGenrator();
                $master->update(['activation_code' => $OTP]);
                 sendOTP($OTP, $request['phone'],'');
                return JsonResponse::successfulResponse('msg_sent_successfully');
            } else {
                return JsonResponse::errorResponse('msg_phone_number_is_not_registered');
            }
        } catch (\Exception $e) {
            return JsonResponse::errorResponse($e->getMessage());
        }
    }

    public function verifyOTP(Request $request)
    {
        try {
            // $master =  $this->masterRepository->findByMultipleAttributes('phone', $request['phone']);

            $master = Master::where('phone', $request['phone'])->where(
                'activation_code',
                $request['activation_code']
            )->first();
            if ($master) {
                $master->update(['is_verified' => 1]);
                return JsonResponse::successfulResponse('msg_verifide_successfully');
            } else {
                return JsonResponse::errorResponse('msg_invalid_verification_code');
            }
        } catch (\Exception $e) {
            return JsonResponse::errorResponse($e->getMessage());
        }
    }

    public function profile(){
        try {
            $master = new MasterResource($this->masterRepository->findBy('id',master()->id));
            return JsonResponse::successfulResponse('msg_success', $master);
        } catch (\Exception $e) {
            return JsonResponse::errorResponse($e->getMessage());
        }
    }

}
