<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Http;
use \App\Http\Controllers\Admin\Auth\AdminAuthController;
use \App\Http\Controllers\Admin\HomeController;
use \App\Http\Controllers\Admin\Nursery\NurseryController;
use \App\Http\Controllers\Admin\Inspections\InspectionController;
use \App\Http\Controllers\Admin\User\AdminController;
use \App\Http\Controllers\Admin\User\InspectorController;
use \App\Http\Controllers\Admin\Master\MasterController;
use \App\Http\Controllers\Admin\Master\ChildController;
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
    $exitCode = Artisan::call('storage:link');
    //$exitCode = Artisan::call('config:cache');
    return 'DONE'; //Return anything
});

Route::get('adminLogin', [AdminAuthController::class, 'adminLoginFrom'])->name('adminLogin');
Route::post('adminLogin', [AdminAuthController::class, 'adminLogin'])->name('adminLogin.store');

Route::group(['prefix' => LaravelLocalization::setLocale(), 'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath']],
    function () {
        Route::prefix('__bh_')->name('__bh_.')->middleware(['auth:dashboard', 'web'])->group(function () {
            Route::get('/', [HomeController::class, 'index'])->name('index');
            Route::get('profile', [HomeController::class, 'profile'])->name('profile');
            Route::post('profile', [HomeController::class, 'update_profile'])->name('update_profile');
            Route::get('profile/password',  [HomeController::class, 'change_password'])->name('profile.password');
            Route::post('profile/password', [HomeController::class, 'update_password'])->name('profile.update_password');

            Route::resource('nurseries',NurseryController::class);
            Route::get('nursery/active/{id}', [NurseryController::class, 'active'])->name('nursery.active');
            Route::get('nursery/block/{id}', [NurseryController::class, 'block'])->name('nursery.block');
            Route::get('nursery/inspector', [NurseryController::class, 'inspector_view'])->name('nursery.inspector');
            Route::post('nursery/inspector', [NurseryController::class, 'set_inspector'])->name('nursery.inspector.store');
            Route::get('inspections', [InspectionController::class, 'index'])->name('inspections.index');
            Route::post('inspections', [InspectionController::class, 'store'])->name('inspections.store');
            Route::get('inspections/{id}', [InspectionController::class, 'show'])->name('inspections.show');

            Route::resource('admins',AdminController::class);
            Route::get('admins/remove/{id}', [AdminController::class,'remove'])->name('admins.remove');
            Route::resource('inspectors',InspectorController::class);
            Route::resource('masters',MasterController::class);
            Route::resource('children',ChildController::class);
        });
    });
