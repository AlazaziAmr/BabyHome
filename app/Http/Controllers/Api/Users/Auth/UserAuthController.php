<?php

namespace App\Http\Controllers\Api\Users\Auth;

use App\Functions\FcmNotification;
use App\Helpers\JsonResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Users\RestoreUserRequest;
use App\Http\Requests\Api\Users\UserLoginRequest;
use App\Http\Requests\Api\Users\UserRegistrationRequest;
use App\Http\Resources\Api\Users\UserResource;
use App\Models\Api\Nurseries\Notification;
use App\Models\Api\Nurseries\Nursery;
use App\Models\User;
use App\Notifications\Notifications;
use App\Repositories\Interfaces\Api\Users\IUserRepository;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserAuthController extends Controller
{

    private $userRepository;

    public function __construct(IUserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }


    public function VerfiedUserWithToken($user)
    {
        config(['auth.guards.api.provider' => 'user']);

        $response = ['token' => $user->createToken('Baby Home Client', ['user'])->plainTextToken];
        return (new UserResource($user))->additional(array_merge(['data' => $response], JsonResponse::success()));
    }
    public function userWithToken($user)
    {
        config(['auth.guards.api.provider' => 'user']);

        $response = ['token' => $user->createToken('Baby Home Client', ['user'])->plainTextToken];
        return (new UserResource($user))->additional(array_merge(['data' => $response], JsonResponse::sentSuccssfully()));
    }
    /**
     * User registerion
     *
     * @param Request $request
     *
     * @return UserResource
     */
    public function register(UserRegistrationRequest $request)
    {
        try {
            $user = User::where('email',$request->email)->whereNotNull('email_verified_at')->get();
            if ($user->count() > 0)
            {
                return JsonResponse::errorResponse('الإيميل مستخدم مسبقاً.');
            }
            // sendOTP('15632', '966563064444');
            $data = $request->validated();
            $data['activation_code'] = OTPGenrator();
            $user = $this->userRepository->register($data);
//            $user->sendEmailVerificationNotification();
            sendOTP($user['activation_code'], $user['phone'],'');
            $fcm = new FcmNotification();
            $fcm->save_notification( 'تم التسجيل بنجاح', 'منصة بيبي هوم ترحب بكم',$user['id'],$user['phone']);
            return $this->userWithToken($user);
        } catch (\Exception $e) {
            return JsonResponse::errorResponse($e->getMessage());
        }
    }

    /**
     *user login
     *
     * @param Request $request
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function login(UserLoginRequest $request)
    {
        try {
            $user =  $this->userRepository->findBy('phone', $request['phone']);

            if ($user) {
                $OTP = OTPGenrator();
                $user->update(['activation_code' => 1234]);
                if (!$user['is_verified']) {
//                if (!$request->has('activation_code')) {
                    sendOTP(1234, $request['phone'],'');
//                    sendOTP($OTP, $request['phone'],'');
//                    return JsonResponse::errorResponse('حساب غير محقق.');
                    if (Hash::check($request['password'], $user['password'])) {
                        return $this->userWithToken($user);
                    } else {
                        return JsonResponse::errorResponse('كلمة المرور غير مطابقة');
                    }
                }
//                if (Hash::check($request['password'], $user['password']) && $user['activation_code'] == $request['activation_code']) {
                if (Hash::check($request['password'], $user['password'])) {
                    sendOTP(1234, $request['phone'],'');
//                    sendOTP($OTP, $request['phone'],'');
//                    $user->update(['is_verified' => 1]);
                    return $this->VerfiedUserWithToken($user);
                } else {
                    return JsonResponse::errorResponse('كلمة المرور غير مطابقة');
                }
            } else {
                return JsonResponse::errorResponse('المستخدم غير موجود');
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
            user()->tokens()->delete();
            // $token = user('api')->token();
            // $token->revoke();
            return JsonResponse::successfulResponse('تم تسجيل الخروج بنجاح');
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
            $user =  $this->userRepository->findBy('phone', $request['phone']);
            if ($user) {
                $user->update(['activation_code' => OTPGenrator()]);
                sendOTP($user['activation_code'], $user['phone'],'');
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
            // $user =  $this->userRepository->findByMultipleAttributes('phone', $request['phone']);

            $user = User::where('phone', $request['phone'])->where(
                'activation_code',
                $request['activation_code']
            )->first();
            if ($user) {
                $user->update(['is_verified' => 1]);
                return JsonResponse::successfulResponse('msg_verifide_successfully');
            } else {
                return JsonResponse::errorResponse('phone_not_registered_or_invalid_code');
            }
        } catch (\Exception $e) {
            return JsonResponse::errorResponse($e->getMessage());
        }
    }


    public function hasRegisteredNursery()
    {
        try {
            /*
             * 0 no nursery
             * 1 has block nursery
             * 2 has active nursery
             * */

            $data['has_nursery'] = user()->has_nursery ? true : false;
            $data['status'] = -1;
            if($data['has_nursery'])
            {
                $nursery = Nursery::where('user_id',user()->id)->get()->first();
                if ($nursery == null) {
                    $user = User::where('id',user()->id)->update(['has_nursery' => 0]);
                    $data['has_nursery'] = false;
                }else{
                    $data['status'] = $nursery->status ? $nursery->status : 'submitted';
                }
            }
            return JsonResponse::successfulResponse('msg_user_check', $data);
        } catch (\Exception $e) {
            return JsonResponse::errorResponse($e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy()
    {
        try {
            user()->tokens()->delete();
            $this->userRepository->delete(user()['id']);
            return JsonResponse::successfulResponse('msg_deleted_succssfully');
        } catch (\Exception $e) {
            return JsonResponse::errorResponse($e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function restoreRequest(RestoreUserRequest $request)
    {
        try {
            $user = $this->userRepository->restoreRequest($request->validated());
            return $this->VerfiedUserWithToken($user);
//            return JsonResponse::successfulResponse('msg_requested_succssfully',$this->VerfiedUserWithToken($user));
        } catch (\Exception $e) {
            return JsonResponse::errorResponse($e->getMessage());
        }
    }
}
