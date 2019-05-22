<?php

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

Route::get('/', 'Admin\SignupController@showLoginForm')->name('/');

Route::post('adminlogin','Admin\SignupController@index')->name('adminlogin');

Route::get('forgot-password','Admin\SignupController@forgotPassword')->name('forgot-password');

Route::get('dashboard','Admin\DashboardController@index')->name('dashboard');

Route::get('logout','Admin\SignupController@logout')->name('logout');

// Packages routes
Route::get('list-packages','Admin\Package\PackageController@packageList')->name('list-packages');
Route::get('edit-package/{package_id}','Admin\Package\PackageController@editPackage')->name('edit-package');
