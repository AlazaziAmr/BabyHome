<?php

namespace App\Http\Controllers\Api\Master\Auth;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Helpers\JsonResponse;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Repositories\Interfaces\Api\Master\IMasterRepository;
use App\Http\Requests\Api\Master\Auth\CheckMasterPhoneRequest;

class MasterResetPasswordController extends Controller
{
    private $masterRepository;

    public function __construct(IMasterRepository $masterRepository)
    {
        $this->masterRepository = $masterRepository;
    }
    public function checkPhone(CheckMasterPhoneRequest $request)
    {
        try {
            if ($this->masterRepository->findBy('phone', $request['phone'])) {
                $OTP =  OTPGenrator();
                if ($this->masterRepository->IsAskedToReset(['phone' => $request['phone']])) {
                    $this->masterRepository->updateToReset('phone', $request['phone'], [
                        'token'      => $OTP,
                        'is_reset_verified' => 0,
                        'created_at' => Carbon::now()
                    ]);
                } else {
                    $this->masterRepository->askToReset([
                        'phone'      => $request['phone'],
                        'token'      => $OTP,
                        'created_at' => Carbon::now(),
                    ]);
                }
                // sendOTP($master['activation_code'], $master['phone'],$message = '');
                return JsonResponse::successfulResponse('msg_sent_successfully');
            } else {
                return JsonResponse::errorResponse('msg_phone_number_is_not_registered');
            }
        } catch (\Exception $e) {
            return JsonResponse::errorResponse($e->getMessage());
        }
    }

    public function verifyToReset(Request $request)
    {
        try {

            if ($this->masterRepository->IsAskedToReset([
                'phone' => $request['phone'],
                'token' => $request['otp'],
            ])) {
                $this->masterRepository->updateToReset(
                    'phone',
                    $request['phone'],
                    ['is_reset_verified' => 1]
                );
                return JsonResponse::successfulResponse('msg_phone_number_verified');
            } else {
                return JsonResponse::errorResponse('msg_invalid_verification_code');
            }
        } catch (\Exception $e) {
            return JsonResponse::errorResponse($e->getMessage());
        }
    }

    public function passwordReset(CheckMasterPhoneRequest $request)
    {
        try {
            $this->masterRepository->update(['password' => Hash::make($request['password'])], $request['phone'], 'phone');
            $this->masterRepository->cleanUp('phone' , $request['phone']);
            return JsonResponse::successfulResponse('msg_your_password_changed_successfully');
        } catch (\Exception $e) {
            return JsonResponse::errorResponse($e->getMessage());
        }
    }
}
