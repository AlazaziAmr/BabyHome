<?php

use App\Helpers\JsonResponse;
use App\Models\Api\Admin\Admin;
use App\Models\Api\Master\Master;
use App\Models\User;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManagerStatic as Image;



if (!function_exists('user')) {

    /**
     * get authenticated user
     *
     * @return User|\Illuminate\Contracts\Auth\Authenticatable|null
     */
    function user()
    {
        return auth('api')->check() ? auth('api')->user() : new User();
    }
}

if (!function_exists('admin')) {

    /**
     * get authenticated admin
     *
     * @return Admin|\Illuminate\Contracts\Auth\Authenticatable|null
     */
    function admin()
    {
        return auth('admin')->check() ? auth('admin')->user() : new Admin();
    }
}
if (!function_exists('master')) {

    /**
     * get authenticated master
     *
     * @return Admin|\Illuminate\Contracts\Auth\Authenticatable|null
     */
    function master()
    {
        return auth('master')->check() ? auth('master')->user() : new Master();
    }
}

if (!function_exists('clean_description')) {

    function clean_description($text)
    {
        return str_replace(["\r\n", '&nbsp;'], ' ', filter_var($text, FILTER_SANITIZE_STRING));
    }
}

if (!function_exists('OTPGenrator')) {

    /**
     * generate 5 digit for the sms code
     * @return int
     */
    function OTPGenrator()
    {
//        return '1234';
         return rand(1000, 9999);
    }
}

if (!function_exists('sendOTP')) {


    /**
     * send  OTP as Sms
     *
     * @param integer $OTP
     * @param string  $phone
     * @param string  $message
     */
    function sendOTP($OTP, $phone, $message = 'رمز التحقق للدخول هو  %s , أهلا بك عميلنا العزيز')
    {
        //!function_exists('send_verification_code')
         try {
             $phone = str_replace('+9660','966',$phone);
             $phone = str_replace('+966','966',$phone);
                $message = "رمز التحقق: $OTP";
                $response = Http::post('https://www.msegat.com/gw/sendsms.php', [
                    "userName"    => "babyhome",
                    "apiKey"      => "0eacc90c694d720222a39c3b74241915",
                    "numbers"     => $phone,
                    "userSender"  => "babyhome",
                    "msg"         => $message,
                    "msgEncoding" => "UTF8",
                ]);
//                dd($response->body());
            } catch (\Exception $e) {
                return JsonResponse::errorResponse($e->getMessage());
            }

        return  true;

    }
}


if (!function_exists('sendAdMessage')) {


    /**
     * send  Advertisement Sms
     *
     * @param string  $phone
     * @param string  $message
     */
    function sendAdMessage($phone, $message)
    {

         try {
             $phone = str_replace('+9660','966',$phone);
             $phone = str_replace('+966','966',$phone);
                $response = Http::post('https://www.msegat.com/gw/sendsms.php', [
                    "userName"    => "babyhome",
                    "apiKey"      => "0eacc90c694d720222a39c3b74241915",
                    "numbers"     => $phone,
                    "userSender"  => "BabyHome-ad",
                    "msg"         => $message,
                    "msgEncoding" => "UTF8",
                ]);

            } catch (\Exception $e) {
                return JsonResponse::errorResponse($e->getMessage());
            }

        return true;

    }
}

// if (!function_exists('executeBase64')) {

//     /**
//      * save base64
//      *
//      */
//     function executeBase64($model, $files, $destination = null)
//     {
//         foreach ($files as $file) {
//             if (preg_match('/^data:image\/(\w+);base64,/', $file)) {
//                 $extension = explode('/', explode(':', substr($file, 0, strpos($file, ';')))[1])[1];
//                 $replace = substr($file, 0, strpos($file, ',') + 1);
//                 $image = str_replace($replace, '', $file);
//                 $image = str_replace(' ', '+', $image);
//                 $imageName = Str::random(10) . '.' . $extension;
//                 Storage::disk('public')->put($imageName, base64_decode($image));
//                 $model->images()->create(['image' => $imageName, 'type' => $extension]);
//             }
//         }
//     }
// }

// if (!function_exists('uploadAttachment')) {
//     function uploadAttachment($model, $request, $fileName = 'attachments', $folderName = 'attachments')
//     {

//         if ($request->hasFile($fileName)) {
//             $attachments = $request->file($fileName);
//             foreach ($attachments as $attachment) {
//                 $extension = explode('/', mime_content_type($attachment['file']))[1];
//                $attachment['file'] = str_replace(' ', '+', $attachment['file']);
//                 $attachmentName = Str::random(10) . '.' . $extension;
//                 Storage::disk('public')->put($attachmentName, base64_decode($attachment['file']));
//                 $model->attachmentable()->create([
//                     'title' => $attachment['title'],
//                     'description' => $attachment['description'],
//                     'path' => $attachmentName,
//                 ]);
//             }
//         }
//     }
// }
if (!function_exists('uploadAttachment')) {
    function uploadAttachment($model, $request, $fileName = 'attachments', $folderName = 'attachments')
    {
        $extensions = ['jpeg', 'png', 'jpg', 'gif'];

        foreach ($request[$fileName] as $attachment) {
            $fileBaseName = str_replace(
                '.' . $attachment['file']->getClientOriginalExtension(),
                '',
                $attachment['file']->getClientOriginalName()
            );
            $newFileName = strtolower(time() . str_random(5) . '-' . str_slug($fileBaseName)) . '.' . $attachment['file']->getClientOriginalExtension();
            if (in_array(strtolower($attachment['file']->getClientOriginalExtension()), $extensions)) {
                $resized_image = Image::make($attachment['file']->getRealPath());
                $resized_image->stream('jpg', 50);
                Storage::disk('public')->put($folderName  . '/' . $newFileName, $resized_image);
            } else {
                Storage::disk('public')->put($folderName  . '/' . $newFileName, file_get_contents($attachment['file']));
            }
            $model->attachmentable()->create([
                'title' => $attachment['title'] ?? null,
                'description' => $attachment['description'] ?? null,
                'path' => $newFileName,
            ]);
        }
    }


    if (!function_exists('getAllAttachments')) {


        function getAllAttachments($attachments, $fileName)
        {
            $allAttachments = [];
            foreach ($attachments  as $key => $attachment) {
                $allAttachments[$key]['title'] = $attachment->title;
                $allAttachments[$key]['description'] = $attachment->description;
                $allAttachments[$key]['path'] = asset('storage/' . $fileName . '/' . $attachment->path);
            }
            return $allAttachments;
        }
    }

    if (!function_exists('sendFireBaseNotification')) {
        function sendFireBaseNotification(
            $title,
            $description,
            $imageUrl = null,
            $sendType = null,
            $ids = [],
            $entityId = null
        ) {
            //        $entity = entity::find($entityId);
            fcm()->to($ids)->priority('high')->timeToLive(0)->data([
                'title' => $title,
                //            'link'  => $entity == null ? url('/') : 'snapsell://entity/notify/' . $entity,
            ])->notification([
                'title' => $title,
                'body'  => $description,
                'image' => $imageUrl,
                //            'link'  => $entity == null ? url('/') : 'snapsell://entity/notify/' . $entity,
            ])->send();
        }
    }
}
    // if (!function_exists('uploadImage')) {
    //     function uploadImage($request, $fileName = 'image', $folderName = 'images')
    //     {
    //         $file = $request->file($fileName);
    //         $fileBaseName = str_replace(
    //             '.' . $file->getClientOriginalExtension(),
    //             '',
    //             $file->getClientOriginalName()
    //         );
    //         $newFileName = strtolower(time() . str_random(5) . '-' . str_slug($fileBaseName)) . '.' . $file->getClientOriginalExtension();
    //         $resizeFile = \Image::make($file->getRealPath());
    //         $resizeFile->save('storage/' . $folderName . '/' . $newFileName);
    //         return asset('storage/' . $folderName . '/' . $newFileName);
    //     }
    // }

    // if (!function_exists('uploadImageWithReturnPath')) {
    //     function uploadImageWithReturnPath($request, $fileName = 'image', $folderName = 'images')
    //     {
    //         $file = $request->file($fileName);
    //         $fileBaseName = str_replace(
    //             '.' . $file->getClientOriginalExtension(),
    //             '',
    //             $file->getClientOriginalName()
    //         );
    //         $newFileName = strtolower(time() . str_random(5) . '-' . str_slug($fileBaseName)) . '.' . $file->getClientOriginalExtension();
    //         $resizeFile = \Image::make($file->getRealPath());
    //         $resizeFile->save('storage/' . $folderName . '/' . $newFileName);
    //         return public_path('storage/' . $folderName . '/' . $newFileName);
    //     }
    // }
