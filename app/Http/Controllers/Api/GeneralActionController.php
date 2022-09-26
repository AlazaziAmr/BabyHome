<?php

namespace App\Http\Controllers\Api;

use App\Helpers\JsonResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Generals\FcmRequest;
use App\Models\Api\Admin\Admin;
use App\Models\Api\Master\Master;
use App\Models\User;

class GeneralActionController extends Controller
{

    public function switch($locale)
    {

        try {
            app()->setLocale($locale);
            return JsonResponse::successfulResponse('switched');
        } catch (\Exception $e) {
            return JsonResponse::errorResponse($e->getMessage());
        }
    }

    public function updateFcmToken(FcmRequest $request)
    {

        try {
            if ($request['type'] == 'user') {
                User::where('id', $request['id'])->update(['fcm_token' => $request['fcmToken']]);
            } else if ($request['type'] == 'master') {
                Master::where('id', $request['id'])->update(['fcm_token' => $request['fcmToken']]);
            } else if ($request['type'] == 'admin') {
                Admin::where('id', $request['id'])->update(['fcm_token' => $request['fcmToken']]);
            }
            return JsonResponse::successfulResponse('updated_successfully');
        } catch (\Exception $e) {
            return JsonResponse::errorResponse($e->getMessage());
        }
    }
}
