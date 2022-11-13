<?php

use App\Http\Controllers\Api\Admin\Auth\AdminAuthController;
use App\Http\Controllers\Api\Admin\Inspections\InspectionController;
use App\Http\Controllers\Api\Admin\Notification\AdminNotificationController;
use App\Http\Controllers\Api\Admin\Nurseries\AdminNurseryController;
use App\Http\Controllers\Api\Admin\RestoreRequest\RestoreRequestController;
use App\Http\Controllers\Api\Admin\Roles\RoleController;
use App\Http\Controllers\Api\GeneralActionController;
use App\Http\Controllers\Api\Generals\ActivityController;
use App\Http\Controllers\Api\Generals\AmenityController;
use App\Http\Controllers\Api\Generals\BankController;
use App\Http\Controllers\Api\Generals\CityController;
use App\Http\Controllers\Api\Generals\CountryController;
use App\Http\Controllers\Api\Generals\DayController;
use App\Http\Controllers\Api\Generals\GenderController;
use App\Http\Controllers\Api\Generals\LanguageController;
use App\Http\Controllers\Api\Generals\NeighborhoodController;
use App\Http\Controllers\Api\Generals\NurseryServiceTypeController;
use App\Http\Controllers\Api\Generals\PackagesTypeController;
use App\Http\Controllers\Api\Generals\QualificationController;
use App\Http\Controllers\Api\Generals\RelationController;
use App\Http\Controllers\Api\Generals\ServiceController;
use App\Http\Controllers\Api\Generals\UtilityController;
use App\Http\Controllers\Api\Master\Auth\MasterAuthController;
use App\Http\Controllers\Api\Master\Auth\MasterResetPasswordController;
use App\Http\Controllers\Api\Master\Children\ChildController;
use App\Http\Controllers\Api\Master\JoinRequest\MasterJoinRequestController;
use App\Http\Controllers\Api\Nurseries\JoinRequest\JoinRequestController;
use App\Http\Controllers\Api\Nurseries\NurseryController;
use App\Http\Controllers\Api\Users\Auth\RestPasswordController;
use App\Http\Controllers\Api\Users\Auth\UserAuthController;
use App\Http\Controllers\Api\VerifyEmailController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\Nurseries\Profile\BabySitterController;
use \App\Http\Controllers\Api\Nurseries\Profile\BabySitterSkillController;
use \App\Http\Controllers\Api\Nurseries\Profile\ProfileController;
use \App\Http\Controllers\Api\Master\Children\ChildSicknessController;
use \App\Http\Controllers\Api\Master\Children\ChildAllergyController;
use \App\Http\Controllers\Api\Master\Children\ChildAlertController;

//  ========================================================Public==================================================================
Route::post('/testsave',function (\Illuminate\Http\Request $request){
   dd($request['licenses']['attachments']);
});
Route::group(['as' => 'api.', 'middleware' => ['cors', 'json.response']], function () {

    // switchLang
    Route::get('/language-switch/{locale}', [GeneralActionController::class, 'switch']);
    Route::post('/update-firebase-token', [GeneralActionController::class, 'updateFcmToken']);

    // Admin auth
    Route::post('/admin/login', [AdminAuthController::class, 'adminLogin']);

    // customer auth
    Route::post('/register', [UserAuthController::class, 'register']);
    Route::post('/login', [UserAuthController::class, 'login']);
    Route::post('/user-restore', [UserAuthController::class, 'restoreRequest']);

    // customer auth
    Route::post('/master/register', [MasterAuthController::class, 'register']);
    Route::post('/master/login', [MasterAuthController::class, 'login']);

    // countries
    Route::get('/countries', [CountryController::class, 'index']);
    Route::get('/countries/{country}', [CountryController::class, 'show']);
    Route::get('/countries/{country}/cities', [CountryController::class, 'countryCities']);

    // cities
    Route::get('/cities', [CityController::class, 'index']);
    Route::get('/cities/{city}', [CityController::class, 'show']);
    Route::get('/cities/{city}/neighborhoods', [CityController::class, 'cityNeighborhoods']);

    // cities
    Route::get('/neighborhoods', [NeighborhoodController::class, 'index']);
    Route::get('/neighborhoods/{neighborhood}', [NeighborhoodController::class, 'show']);
// languages
    Route::get('/languages', [LanguageController::class, 'index']);
    Route::get('/languages/{language}', [LanguageController::class, 'show']);

    // reset password
    Route::post('/confirm-phone-number', [RestPasswordController::class, 'checkPhone']);
    Route::post('/reset-verification', [RestPasswordController::class, 'verifyToReset']);
    Route::post('/reset-password', [RestPasswordController::class, 'passwordReset']);

    Route::post('/master/confirm-phone-number', [MasterResetPasswordController::class, 'checkPhone']);
    Route::post('/master/reset-verification', [MasterResetPasswordController::class, 'verifyToReset']);
    Route::post('/master/reset-password', [MasterResetPasswordController::class, 'passwordReset']);
    Route::post('/master/master-restore', [MasterAuthController::class, 'restoreRequest']);

    Route::get('/qualifications', [QualificationController::class, 'index']);
    Route::get('/all-qualifications', [QualificationController::class, 'index']);
    Route::post('/qualifications', [QualificationController::class, 'store']);
    Route::post('/qualifications', [QualificationController::class, 'store']);


    // nationalities
    Route::get('nationalities', [\App\Http\Controllers\Api\Generals\NationalityController::class, 'index']);

    Route::get('privacy', [\App\Http\Controllers\Api\Generals\PrivacyController::class, 'index']);
});


// =====================================auth:sanctum===================Admins & Customers==================================================================


Route::group(['as' => 'api.', 'middleware' => ['cors', 'json.response', 'auth:sanctum', 'ability:user,admin', 'locale']], function () {
    // qualifications
    Route::get('/qualifications', [QualificationController::class, 'index']);
    Route::get('/qualifications/{qualification}', [QualificationController::class, 'show']);

    // genders
    Route::get('/genders', [GenderController::class, 'index']);
    Route::get('/genders/{gender}', [GenderController::class, 'show']);

    // relations
    Route::get('/relations', [RelationController::class, 'index']);
    Route::get('/relations/{relation}', [RelationController::class, 'show']);

    /* profile */
    Route::get('/nurseryProfile', [NurseryController::class, 'nurseryProfile']);
    Route::get('/babySitter', [BabySitterController::class, 'index']);
    Route::post('/babySitter', [BabySitterController::class, 'update']);
    Route::resource('sitterQualifications', \App\Http\Controllers\Api\Nurseries\Profile\BabySitterQuanlificationController::class);
    Route::get('/nursery-amenities/{nursery_id}', [ProfileController::class, 'amenities']);
    Route::get('notifications', [\App\Http\Controllers\Api\Nurseries\Profile\NotificationController::class, 'index']);

    // nursery services types
    Route::get('/nursery-services-types', [NurseryServiceTypeController::class, 'index']);
    Route::get('/nursery-sub-services-types/{parent_id}', [NurseryServiceTypeController::class, 'subServices']);
    Route::get('/nursery-services-types/{nurseryServicesType}', [NurseryServiceTypeController::class, 'show']);
    Route::get('/nursery-services-types/{nurseryServicesType}/children', [NurseryServiceTypeController::class, 'children']);
    Route::get('/nursery-services-types/{nurseryServicesType}/activities', [NurseryServiceTypeController::class, 'typeActivities']);

    Route::apiResource('activities', ActivityController::class);

    // utility
    Route::get('/utilities', [UtilityController::class, 'index']);
    Route::get('/utilities/{utility}', [UtilityController::class, 'show']);

    // amenities
    Route::get('/amenities', [AmenityController::class, 'index']);
    Route::get('/amenities/{amenity}', [AmenityController::class, 'show']);

    // services
    Route::get('/services', [ServiceController::class, 'index']);
    Route::get('/services/{service}', [ServiceController::class, 'show']);
});


// ========================================================Admins==================================================================


Route::group(['as' => 'api.', 'middleware' => ['auth:sanctum', 'ability:admin', 'cors', 'json.response', 'locale'], 'prefix' => 'admin'], function () {

    // Auth
    Route::get('/all', [AdminAuthController::class, 'index']);
    Route::post('/register', [AdminAuthController::class, 'adminRegister']);
    Route::post('/logout', [AdminAuthController::class, 'adminLogout']);
    Route::get('/notifications', [AdminNotificationController::class, 'notifications']);
    Route::get('/notifications/{adminNotification}/read', [AdminNotificationController::class, 'markAsSeen']);

    Route::resource('roles', RoleController::class);
    Route::get('/permissions', [RoleController::class, 'fetchPermissions']);

    // countries
    Route::post('/countries', [CountryController::class, 'store']);
    Route::put('/countries/{country}', [CountryController::class, 'update']);
    Route::delete('/countries/{country}', [CountryController::class, 'destroy']);

    // cities
    Route::post('/cities', [CityController::class, 'store']);
    Route::put('/cities/{city}', [CityController::class, 'update']);
    Route::delete('/cities/{city}', [CityController::class, 'destroy']);

    // neighborhoods
    Route::post('/neighborhoods', [NeighborhoodController::class, 'store']);
    Route::put('/neighborhoods/{neighborhood}', [NeighborhoodController::class, 'update']);
    Route::delete('/neighborhoods/{neighborhood}', [NeighborhoodController::class, 'destroy']);


    // languages
    Route::post('/languages', [LanguageController::class, 'store']);
    Route::put('/languages/{language}', [LanguageController::class, 'update']);
    Route::delete('/languages/{language}', [LanguageController::class, 'destroy']);

    // nursery services types
    Route::post('/nursery-services-types', [NurseryServiceTypeController::class, 'store']);
    Route::put('/nursery-services-types/{nurseryServicesType}', [NurseryServiceTypeController::class, 'update']);
    Route::delete('/nursery-services-types/{nurseryServicesType}', [NurseryServiceTypeController::class, 'destroy']);


    // qualifications
    Route::post('/qualifications', [QualificationController::class, 'store']);
    Route::put('/qualifications/{qualification}', [QualificationController::class, 'update']);
    Route::delete('/qualifications/{qualification}', [QualificationController::class, 'destroy']);
    // genders
    Route::post('/genders', [GenderController::class, 'store']);
    Route::put('/genders/{gender}', [GenderController::class, 'update']);
    Route::delete('/genders/{gender}', [GenderController::class, 'destroy']);

    // relations
    Route::post('/relations', [RelationController::class, 'store']);
    Route::put('/relations/{relation}', [RelationController::class, 'update']);
    Route::delete('/relations/{relation}', [RelationController::class, 'destroy']);


    // utility
    Route::post('/utilities', [UtilityController::class, 'store']);
    Route::put('/utilities/{utility}', [UtilityController::class, 'update']);
    Route::delete('/utilities/{utility}', [UtilityController::class, 'destroy']);

    // amenities
    Route::post('/amenities', [AmenityController::class, 'store']);
    Route::put('/amenities/{amenity}', [AmenityController::class, 'update']);
    Route::delete('/amenities/{amenity}', [AmenityController::class, 'destroy']);

    // services
    Route::post('/services', [ServiceController::class, 'store']);
    Route::put('/services/{service}', [ServiceController::class, 'update']);
    Route::delete('/services/{service}', [ServiceController::class, 'destroy']);

    // banks
    Route::apiResource('banks', BankController::class);

    // packages-type
    Route::post('/packages-type', [PackagesTypeController::class, 'store']);
    Route::put('/packages-type/{packagesType}', [PackagesTypeController::class, 'update']);
    Route::delete('/packages-type/{packagesType}', [PackagesTypeController::class, 'destroy']);

    // Nurseries
    Route::get('/nurseries', [AdminNurseryController::class, 'index']);
    Route::delete('/nursery/{nursery}', [AdminNurseryController::class, 'destroy']);
    Route::post('/nursery/{nursery}/activate', [AdminNurseryController::class, 'activate']);
    Route::get('/nursery/{nursery}/details', [AdminNurseryController::class, 'show']);
    Route::post('/nursery/check/assign-to', [AdminNurseryController::class, 'assignTo']);
    // inspections
    Route::get('/inspections', [InspectionController::class, 'index']);
    Route::post('/inspection/status/update', [InspectionController::class, 'statusUpdate']);
    Route::post('/inspection/result', [InspectionController::class, 'submitResult']);
    Route::post('/inspection/result/details', [InspectionController::class, 'showResult']);

    Route::get('/restore-requests', [RestoreRequestController::class, 'fetchUsers']);
    Route::patch('/user/{user}/restore', [RestoreRequestController::class, 'userUpdateStatus']);
});


// ========================================================Customers==================================================================

Route::group(['middleware' => ['auth:sanctum', 'ability:user', 'cors', 'json.response', 'locale']], function () {
    Route::post('/send/verification-email', [VerifyEmailController::class, 'sendVerificationEmail']);
    Route::get('/verify-email/{id}/{hash}', [VerifyEmailController::class, 'verify'])->name('verification.verify');
});
Route::group(['as' => 'api.', 'middleware' => ['auth:sanctum', 'ability:user', 'cors', 'json.response', 'locale']], function () {


    // Auth
    Route::post('/logout', [UserAuthController::class, 'logout']);
    Route::delete('/account-delete', [UserAuthController::class, 'destroy']);
    Route::post('/resend', [UserAuthController::class, 'resendOTP']);
    Route::post('/verify', [UserAuthController::class, 'verifyOTP']);

    Route::get('/has-nursery', [UserAuthController::class, 'hasRegisteredNursery']);

    Route::get('/days', [DayController::class, 'index']);

    // Nurseries

    Route::apiResource('nursery-amenity', \App\Http\Controllers\Api\Nurseries\Profile\AmenitieController::class);
    Route::apiResource('/nursery-skills', BabySitterSkillController::class);
    Route::apiResource('/nursery-services', \App\Http\Controllers\Api\Nurseries\Profile\NurseryServiceInfoController::class);
    Route::delete('attachments/{id}', [\App\Http\Controllers\Api\Nurseries\Profile\NurseryServiceInfoController::class, 'delete_attachment']);
    Route::apiResource('/nursery-qualifications', \App\Http\Controllers\Api\Nurseries\Profile\BabySitterQuanlificationController::class);


    Route::apiResource('nurseries', NurseryController::class);
    Route::post('/join-request-approve/{id}', [NurseryController::class, 'approveJoinigRequest']);
    Route::get('nursery/{nursery}/children', [NurseryController::class, 'getNurseryChildren']);

    Route::get('/nursery-requests/{id}', [JoinRequestController::class, 'nurseryUnapprovedJoining']);
});


// ========================================================Masters========================================================================
Route::group(['as' => 'api.', 'middleware' => ['auth:sanctum', 'ability:master', 'cors', 'json.response', 'locale'], 'prefix' => 'master'], function () {

    // Auth
    Route::get('/profile', [MasterAuthController::class, 'profile']);
    Route::post('/logout', [MasterAuthController::class, 'logout']);
    Route::post('/resend', [MasterAuthController::class, 'resendOTP']);
    Route::post('/verify', [MasterAuthController::class, 'verifyOTP']);
    Route::post('/update-email', [MasterAuthController::class, 'updateEmail']);
    Route::post('/verify-email', [MasterAuthController::class, 'verifyEmail']);
    Route::delete('/account-delete/{id}', [MasterAuthController::class, 'destroy']);

    // Children
    Route::apiResource('children', ChildController::class);

    Route::get('child-sickness/{id}', [ChildSicknessController::class, 'index']);
    Route::apiResource('child-sickness', ChildSicknessController::class)->except(['show']);
    Route::apiResource('child-allergies', ChildAllergyController::class)->except(['show']);
    Route::apiResource('child-alerts', ChildAlertController::class)->except(['show']);

    Route::get('/nearest-nurseries', [NurseryController::class, 'nurseriesCloseToMaster']);

    // Joining Request
    Route::get('/nursery/{nursery}/packages-type/{type}', [NurseryController::class, 'getPackages']);
    Route::get('/nursery/{nursery}/activities', [NurseryController::class, 'getActivities']);


    Route::post('/join-request', [MasterJoinRequestController::class, 'store']);
});


// =====================================auth:sanctum===================Admins & Masters==================================================================


Route::group(['as' => 'api.', 'middleware' => ['cors', 'json.response', 'auth:sanctum', 'ability:user,master', 'locale']], function () {
    // Generals
    Route::get('/packages-type', [PackagesTypeController::class, 'index']);
    Route::get('child-profile/{id}', [ChildController::class, 'show']);
    Route::get('child-sickness/{id}', [ChildSicknessController::class, 'index']);
    Route::get('child-allergies/{id}', [ChildAllergyController::class, 'index']);
    Route::get('child-alerts/{id}', [ChildAlertController::class, 'index']);
    Route::get('/filter-master', [MasterJoinRequestController::class, 'filterMaster']);

});

Route::group(['as' => 'api.', 'middleware' => ['cors', 'json.response', 'locale']], function () {
    Route::get('/profile', [\App\Http\Controllers\Api\Nurseries\Profile\ProfileController::class, 'profile']);
    Route::get('/nursery-profile/{id}', [\App\Http\Controllers\Api\Nurseries\Profile\ProfileController::class, 'nursery_profile']);
    Route::get('/update-email', [\App\Http\Controllers\Api\Nurseries\Profile\ProfileController::class, 'updateEmail']);
    Route::get('/verify-email', [\App\Http\Controllers\Api\Nurseries\Profile\ProfileController::class, 'verifyEmail']);
});


