<?php

namespace App\Notifications;

use App\Models\User;
use Illuminate\Bus\Queueable;
use App\Models\Api\Master\Master;
use App\Jobs\FireBaseNotification;
use App\Models\Api\Admin\Admin;
use Illuminate\Notifications\Notification;


class Notifications extends Notification
{
    use Queueable;

    public static $mobile;
    public static $deviceTokens = [];

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function through($via)
    {
        self::$mobile = in_array('mobile', $via);
        return new self;
    }

    public function to($userType, $ids = null)
    {
        if ($userType == 'user') {
            $notifiable = User::whereIn('id', $ids)->get();
        } else if ($userType == 'master') {
            $notifiable = Master::whereIn('id', $ids)->get();
        } else if ($userType == 'admin') {
            $notifiable = Admin::whereIn('id', $ids)->get();
        }
        self::$deviceTokens = $notifiable->pluck('fcm_token')->toArray();
        return new self;
    }

    public function send($description, $title = null, $imageUrl = null, $userType = null, $entityId = null)
    {
      
        if (self::$mobile) {
            FireBaseNotification::dispatch(
                $title,
                $description,
                $imageUrl,
                $userType,
                self::$deviceTokens,
                $entityId
            );
        }
    }
}
