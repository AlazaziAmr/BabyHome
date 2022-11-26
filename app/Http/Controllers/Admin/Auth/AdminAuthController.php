<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Helpers\JsonResponse;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\Api\Admin\Auth\AdminLoginRequest;

class AdminAuthController extends Controller
{


    public function adminLoginFrom()
    {
        $data['title'] = __('site.login');
        return view('dashboard.auth.login', compact('data'));
    }


    public function adminLogin(Request $request)
    {
        $this->validate($request, [
            'username' => 'required',
            'password' => 'required|min:6'
        ]);

        if (Auth::guard('admin')->attempt(['username' => $request->username, 'password' => $request->password])) {

            return redirect(route( '__bh_.index'));
        }
        return back()->withInput($request->only('email', 'remember'));
    }


    public function adminLogout()
    {
        try {
            Auth::guard('admin')->logout();
            return redirect(route( 'adminLogin'));
//            admin()->update([
//                'fcm_token' => null
//            ]);
//            admin()->tokens()->delete();
//            return JsonResponse::successfulResponse('msg_logged_out_succssfully');
        } catch (\Exception $e) {
            return JsonResponse::errorResponse($e->getMessage());
        }
    }
}
