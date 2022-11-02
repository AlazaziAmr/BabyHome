<?php

use Illuminate\Support\Facades\Artisan;
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
use \App\Http\Controllers\Admin\General\CityController;
use \App\Http\Controllers\Admin\General\NationalityController;
use \App\Http\Controllers\Admin\General\CountryController;
use \App\Http\Controllers\Admin\User\UserController;
use \App\Http\Controllers\Admin\General\NeighborhoodController;
use \App\Http\Controllers\Admin\Nursery\Addtioanl\AmenityController;
use \App\Http\Controllers\Admin\Nursery\Addtioanl\QualificationController;

Route::get('/test_sms', function () {
    $OTP = '1234';
    $message = "رمز التحقق: $OTP";
    $response = Http::post('https://www.msegat.com/gw/sendsms.php', [
        "userName"    => "babyhome",
        "apiKey"      => "0eacc90c694d720222a39c3b74241915",
        "numbers"     => '00966581773710',
        "userSender"  => "babyhome",
        "msg"         => $message,
        "msgEncoding" => "UTF8",
        "lang" => "ar",
    ]);
    dd($response->body());
});


Route::get('test_notes',function (){
    $fcm = new \App\Functions\FcmNotification();

    $fcm->send_notification("test",'meesgae','all');
});

Route::get('/clear-cache', function () {
    $exitCode = Artisan::call('config:clear');
    $exitCode = Artisan::call('cache:clear');
    $exitCode = Artisan::call('view:clear');
    $exitCode = Artisan::call('route:clear');
    $exitCode = Artisan::call('clear-compiled');
    $exitCode = Artisan::call('storage:link');
    //$exitCode = Artisan::call('config:cache');
//    return 'DONE'; //Return anything




    implode(',',$phone);
    echo ($phone);
});

Route::get('adminLogin', [AdminAuthController::class, 'adminLoginFrom'])->name('adminLogin');
Route::get('/login',[AdminAuthController::class, 'adminLoginFrom'])->name('login');
Route::post('adminLogin', [AdminAuthController::class, 'adminLogin'])->name('adminLogin.store');
Route::post('adminLogout', [AdminAuthController::class, 'adminLogout'])->name('adminLogout');

Route::group(['prefix' => LaravelLocalization::setLocale(), 'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath']],
    function () {
        Route::prefix('__bh_')->name('__bh_.')->middleware(['auth:dashboard', 'web'])->group(function () {
            Route::get('/', [HomeController::class, 'index'])->name('index');
            Route::get('profile', [HomeController::class, 'profile'])->name('profile');
            Route::post('profile', [HomeController::class, 'update_profile'])->name('update_profile');
            Route::get('profile/password',  [HomeController::class, 'change_password'])->name('profile.password');
            Route::post('profile/password', [HomeController::class, 'update_password'])->name('profile.update_password');
            Route::any('notifications/read',[HomeController::class,'read_note'])->name('notifications.read');
            Route::resource('nurseries',NurseryController::class);
            Route::get('nurseries/remove/{id}', [NurseryController::class, 'remove'])->name('nurseries.remove');
            Route::get('nursery/active/{id}', [NurseryController::class, 'active'])->name('nursery.active');
            Route::get('nursery/block/{id}', [NurseryController::class, 'block'])->name('nursery.block');
            Route::get('nursery/inspector', [NurseryController::class, 'inspector_view'])->name('nursery.inspector');
            Route::post('nursery/inspector', [NurseryController::class, 'set_inspector'])->name('nursery.inspector.store');
            Route::get('inspections', [InspectionController::class, 'index'])->name('inspections.index');
            Route::post('inspections', [InspectionController::class, 'store'])->name('inspections.store');
            Route::get('inspections/{id}', [InspectionController::class, 'show'])->name('inspections.show');

            Route::resource('admins',AdminController::class);
            Route::get('admins/remove/{id}', [AdminController::class,'remove'])->name('admins.remove');

            Route::resource('users',UserController::class);
            Route::get('users/remove/{id}', [UserController::class,'remove'])->name('users.remove');

            Route::resource('cities',CityController::class);
            Route::get('cities/remove/{id}', [CityController::class,'remove'])->name('cities.remove');
            Route::post('cities/store_excel', [CityController::class,'store_excel'])->name('cities.store_excel');

            Route::resource('countries',CountryController::class);
            Route::get('countries/remove/{id}', [CountryController::class,'remove'])->name('countries.remove');

            Route::resource('neighborhoods',NeighborhoodController::class);
            Route::get('neighborhoods/remove/{id}', [NeighborhoodController::class,'remove'])->name('neighborhoods.remove');
            Route::post('neighborhoods/store_excel', [NeighborhoodController::class,'store_excel'])->name('neighborhoods.store_excel');

            Route::resource('amenities',AmenityController::class);
            Route::get('amenities/remove/{id}', [AmenityController::class,'remove'])->name('amenities.remove');

            Route::resource('qualifications',QualificationController::class);
            Route::get('qualifications/remove/{id}', [QualificationController::class,'remove'])->name('qualifications.remove');



            Route::resource('nationalities',NationalityController::class);
            Route::get('nationalities/remove/{id}', [NationalityController::class,'remove'])->name('nationalities.remove');
            Route::post('nationalities/store_excel', [NationalityController::class,'store_excel'])->name('nationalities.store_excel');

            Route::resource('inspectors',InspectorController::class);
            Route::resource('masters',MasterController::class);
            Route::resource('children',ChildController::class);
        });
    });
