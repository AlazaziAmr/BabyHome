<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Http;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

//Route::get('test_sms', function () {
//    $OTP = '1234';
//    $message = " تم تسجيل الحاضنه بنجاح طلبك تحت المراجعه ";
//    $response = Http::post('https://www.msegat.com/gw/sendsms.php', [
//        "userName"    => "babyhome",
//        "apiKey"      => "0eacc90c694d720222a39c3b74241915",
//        "numbers"     => '009660558229004',
//        "userSender"  => "OTP",
//        "msg"         => $message,
//        "msgEncoding" => "UTF8",
//        "lang" => "ar",
//    ]);
//    dd($response->body());
//});

Route::get('/clear-cache', function () {
    $exitCode = Artisan::call('config:clear');
    $exitCode = Artisan::call('cache:clear');
    $exitCode = Artisan::call('view:clear');
    $exitCode = Artisan::call('route:clear');
    $exitCode = Artisan::call('clear-compiled');
    //$exitCode = Artisan::call('config:cache');
    return 'DONE'; //Return anything
});

