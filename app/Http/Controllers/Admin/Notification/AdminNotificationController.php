<?php

namespace App\Http\Controllers\Admin\Notification;

use App\Helpers\JsonResponse;
use App\Http\Controllers\Controller;
use App\Http\Resources\Api\Admin\Notification\AdminNotificationResource;
use App\Http\Resources\Api\Generals\NameResource;
use App\Models\Api\Admin\AdminNotification;
use App\Repositories\Interfaces\Api\Admin\IAdminRepository;

class AdminNotificationController extends Controller
{

    private $adminRepository;

    public function __construct(IAdminRepository $adminRepository)
    {
        $this->adminRepository = $adminRepository;
    }

    public function notifications()
    {
        try {
            $notification = $this->adminRepository->notifications();
            return  AdminNotificationResource::collection($notification['notifications'])->additional([
                'count' => $notification['count'],
                'message' =>  trans('responses.msg_recived_successfully'),
                'status' => 200
            ]);
        } catch (\Exception $e) {
            return JsonResponse::errorResponse($e->getMessage());
        }
    }
    public function markAsSeen(AdminNotification $adminNotification)
    {
        try {
            $adminNotification->update(['mark_as_read' => 1]);
            return JsonResponse::successfulResponse(trans('responses.msg_updated_successfully'));
        } catch (\Exception $e) {
            return JsonResponse::errorResponse($e->getMessage());
        }
    }
}
