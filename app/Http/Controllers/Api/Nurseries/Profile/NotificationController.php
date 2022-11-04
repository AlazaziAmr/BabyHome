<?php

namespace App\Http\Controllers\Api\Nurseries\Profile;

use App\Helpers\JsonResponse;
use App\Http\Controllers\Controller;
use App\Models\Api\Nurseries\Notification;
use App\Models\User;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function index(){
        User::findOrFail(user()->id);
        $notification = Notification::where('user_id',user()->id)->select('id','user_id','title','message','created_at')
        ->latest()->get()->take(100);
        return JsonResponse::successfulResponse('msg_success', $notification);
    }
}
