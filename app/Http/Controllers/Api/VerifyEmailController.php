<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Helpers\JsonResponse;
use App\Http\Controllers\Controller;
use Illuminate\Auth\Events\Verified;
use Illuminate\Foundation\Auth\EmailVerificationRequest;

class VerifyEmailController extends Controller
{
    public function sendVerificationEmail(Request $request)
    {
        if ($request->user()->hasVerifiedEmail()) {
            return JsonResponse::errorResponse('already_verified');
        }

        $request->user()->sendEmailVerificationNotification();
        return JsonResponse::errorResponse('verification_link_sent');
    }

    public function verify(EmailVerificationRequest $request)
    {
        if ($request->user()->hasVerifiedEmail()) {
            return JsonResponse::errorResponse('email_already_verified');
        }

        if ($request->user()->markEmailAsVerified()) {
            event(new Verified($request->user()));
        }
        return JsonResponse::errorResponse('email_has_been_verified');
    }
}
