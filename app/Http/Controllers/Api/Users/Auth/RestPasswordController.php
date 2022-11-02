<?php

namespace App\Http\Controllers\Api\Users\Auth;

use App\Helpers\JsonResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Users\CheckPhoneRequest;
use App\Http\Requests\Api\Users\ResetPasswordRequest;
use App\Models\User;
use App\Repositories\Interfaces\Api\Users\IUserRepository;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class RestPasswordController extends Controller
{

    private $userRepository;

    public function __construct(IUserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }
    public function checkPhone(CheckPhoneRequest $request)
    {
        try {
            if ($this->userRepository->findBy('phone', $request['phone'])) {
                $OTP =  OTPGenrator();
                $phone = str_replace('+9660','966',$request['phone']);
                $phone = str_replace('+966','966',$request['phone']);
                if ($this->userRepository->IsAskedToReset(['phone' =>$phone])) {
                    $this->userRepository->updateToReset('phone', $phone, [
                        'token'      => $OTP,
                        'is_reset_verified' => 0,
                        'created_at' => Carbon::now()
                    ]);
                } else {
                    $this->userRepository->askToReset([
                        'phone'      => $phone,
                        'token'      => $OTP,
                        'created_at' => Carbon::now(),
                    ]);
                }
                // sendOTP($user['activation_code'], $user['phone'],$message = '');
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

            $phone = str_replace('+9660','966',$request['phone']);
            $phone = str_replace('+966','966',$request['phone']);

            if ($this->userRepository->IsAskedToReset([
                'phone' => $phone,
                'token' => $request['otp'],
            ])) {
                $this->userRepository->updateToReset(
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

    public function passwordReset(ResetPasswordRequest $request)
    {
        try {
            $phone = str_replace('+9660','966',$request['phone']);
            $phone = str_replace('+966','966',$request['phone']);

            $this->userRepository->update(['password' => Hash::make($request['password'])], $phone, 'phone');
            $this->userRepository->cleanUp('phone' , $request['phone']);
            return JsonResponse::successfulResponse('msg_your_password_changed_successfully');
        } catch (\Exception $e) {
            return JsonResponse::errorResponse($e->getMessage());
        }
    }
}
