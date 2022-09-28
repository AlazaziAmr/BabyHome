<?php

namespace App\Helpers;

class JsonResponse
{
    const MSG_SUCCESS = "responses.success";
    const MSG_FAILED = "responses.failed";
    const MSG_ADDED_SUCCESSFULLY = "responses.added_successfully";
    const MSG_UPDATED_SUCCESSFULLY = "responses.updated_successfully";
    const OTP_SENT_SUCCESS = "responses.otp_sent_success";

    /**
     * @param null $content
     * @param null $content
     * @param null $content
     * @return \Illuminate\Http\JsonResponse
     */
    public static function successfulResponse($message, $payload = null, $status = 200)
    {
        return response()->json([
            'result' => trans(self::MSG_SUCCESS),
            'data' => $payload,
            'message' =>  trans('responses.' . $message),
            'status' => $status
        ],200);
    }

    /**
     * @param $message
     * @return \Illuminate\Http\JsonResponse
     */
    public static function errorResponse($message, $status = 500)
    {
        return response()->json([
            'result' => trans(self::MSG_FAILED),
            'data' => array(),
            'message' => trans('responses.' . $message),
            'status' => "500"
        ]);
    }

    public static function sentSuccssfully()
    {
        return ['result' => trans(self::MSG_SUCCESS), 'message' => trans(self::OTP_SENT_SUCCESS), 'status' => 200];
    }

    public static function success($message = self::MSG_SUCCESS)
    {
        return ['result' => trans(self::MSG_SUCCESS), 'message' => trans('responses.' . $message), 'status' => 200];
    }

    public static function savedSuccessfully()
    {
        return ['result' => trans(self::MSG_SUCCESS), 'message' => trans(self::MSG_ADDED_SUCCESSFULLY), 'status' => 200];
    }

    public static function updatedSuccessfully()
    {
        return ['result' => trans(self::MSG_SUCCESS), 'message' => trans(self::MSG_UPDATED_SUCCESSFULLY), 'status' => 200];
    }
}
