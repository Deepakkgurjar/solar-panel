<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('register-user','HomeController@registerUser');

Route::post('verify-mobile','HomeController@verifyUserMob');

Route::post('verify-mobile-otp','HomeController@verifyMobileOTP');

Route::post('login-user','HomeController@loginUser');

Route::post('forgot-password','HomeController@forgotPassword');

Route::post('verify-otp','HomeController@vefifyOTP');

Route::post('reset-password','HomeController@resetPassword');

Route::post('update-profile','Profile\ProfileController@updateProfile')->middleware('auth:api');

Route::post('all-states','Profile\ProfileController@allStates')->middleware('auth:api');

Route::post('cities','Profile\ProfileController@stateCities')->middleware('auth:api');

Route::post('packages','Package\PackageController@allPackages')->middleware('auth:api');

Route::post('buy-package','Package\PackageController@buyPackage')->middleware('auth:api');

Route::post('my-orders','Order\OrderController@myOrdersList')->middleware('auth:api');

Route::post('home','HomeController@dashboard')->middleware('auth:api');

Route::post('order-summary','Order\OrderController@orderSummary')->middleware('auth:api');

Route::post('order-feedback','Order\OrderController@orderFeedback')->middleware('auth:api');

Route::post('plant-profile','Profile\PlantProfileController@plantProfile')->middleware('auth:api');

Route::post('view-plant-profile','Profile\PlantProfileController@viewPlantProfile')->middleware('auth:api');

Route::post('view-user-profile','Profile\ProfileController@viewUserProfile')->middleware('auth:api');

Route::post('time-slots','Order\OrderController@getTimesSloats');

Route::post('save-order-status','Package\PackageController@saveOrderStatus')->middleware('auth:api');

