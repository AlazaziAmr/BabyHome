<?php

namespace App\Http\Controllers\Api\Admin\Auth;

use App\Helpers\JsonResponse;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Http\Resources\Api\Generals\NameResource;
use App\Http\Resources\Api\Admin\Auth\AdminResource;
use App\Http\Requests\Api\Admin\Auth\AdminLoginRequest;
use App\Http\Requests\Api\Admin\Auth\AdminRegisterRequest;
use App\Repositories\Interfaces\Api\Admin\IAdminRepository;

class AdminAuthController extends Controller
{
    private $adminRepository;

    public function __construct(IAdminRepository $adminRepository)
    {
        $this->adminRepository = $adminRepository;
    }
    public function index()
    {
        try {
            return JsonResponse::successfulResponse('', NameResource::collection($this->adminRepository->fetchAll([], ['id', 'name'])));
        } catch (\Exception $e) {
            return JsonResponse::errorResponse($e->getMessage());
        }
    }

    public function VerfiedAdminWithToken($admin)
    {
        config(['auth.guards.api.provider' => 'admin']);
        $response = ['token' => $admin->createToken('Baby Home Client', ['admin'])->plainTextToken];
        return (new AdminResource($admin))->additional(array_merge(['data' => $response], JsonResponse::success('msg_logged_in_succssfully')));
    }
    /**
     * Admin registerion
     *
     * @param Request $request
     *
     * @return UserResource
     */
    public function adminRegister(AdminRegisterRequest $request)
    {
        try {
            $this->adminRepository->createRequest($request->validated());
            return JsonResponse::successfulResponse('msg_registered_successfully');
        } catch (\Exception $e) {
            return JsonResponse::errorResponse($e->getMessage());
        }
    }


    public function adminLogin(AdminLoginRequest $request)
    {
        try {
            $admin =  $this->adminRepository->findBy('username', $request['username']);
            if ($admin) {
                if (Hash::check($request['password'], $admin['password'])) {
                    return $this->VerfiedAdminWithToken($admin);
                } else {
                    return JsonResponse::errorResponse('msg_password_mismatch');
                }
            } else {
                return JsonResponse::errorResponse('msg_admin_does_not_exist');
            }
        } catch (\Exception $e) {
            return JsonResponse::errorResponse($e->getMessage());
        }
    }


    public function adminLogout()
    {
        try {
            admin()->update([
                'fcm_token' => null
            ]);
            admin()->tokens()->delete();
            return JsonResponse::successfulResponse('msg_logged_out_succssfully');
        } catch (\Exception $e) {
            return JsonResponse::errorResponse($e->getMessage());
        }
    }
}
