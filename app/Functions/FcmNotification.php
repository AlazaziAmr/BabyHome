<?php


namespace App\Functions;


use App\Models\Api\Nurseries\Notification;
use App\Models\Client;
use App\Models\Engineer;
use App\Models\Order;
use App\Models\OrderVat;
use App\Models\User;

class FcmNotification
{
    private $server_key  = "AAAAMAsgzYw:APA91bEE90nrC4RoTqoGnEbpEEJTMxbZzEOmASVXnAwZ71EsOPbbLDFJD8JAaH_pNpfZmD4NJsRlMoEo0U0c03nqgOPBKBGSVNNoQkXq4jim2Y6OhflcXqGwOTqb68ymCzOJAstTDxOg";

    public function save_notification($title,$message,$id,$phone){
        Notification::create([
            'user_id' => $id,
            'title' => $title,
            'message' => $message,
        ]);
        $this->send_notification($title,$message,$phone);
    }
    public function send_notification($title, $message, $topic)
    {
        define('API_ACCESS_KEY', $this->server_key);
        $fcmUrl = 'https://fcm.googleapis.com/fcm/send';

        $topic = str_replace('+9660','966',$topic);
        $topic = str_replace('+966','966',$topic);

        $notification = [
            'title' => $title,
            'body' => $message,
            'icon' => 'myIcon',
            'sound' => 'mySound'
        ];
        $extraNotificationData = ["message" => $notification, "moredata" => 'dd'];

        $fcmNotification = [
            //'registration_ids' => $tokenList, //multple token array
            'to' => '/topics/' . $topic, //single token
            'notification' => $notification,
            'data' => $extraNotificationData
        ];

        $headers = [
            'Authorization: key=' . API_ACCESS_KEY,
            'Content-Type: application/json'
        ];


        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $fcmUrl);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fcmNotification));
        $result = curl_exec($ch);
        curl_close($ch);
       // echo json_encode($result);
        return true;
    }
}
