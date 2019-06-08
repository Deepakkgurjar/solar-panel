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

Route::get('/', 'Admin\SignupController@showLoginForm')->name('login');

Route::post('adminlogin','Admin\SignupController@index')->name('adminlogin');

Route::get('forgot-password','Admin\SignupController@forgotPassword')->name('forgot-password');

Route::get('dashboard','Admin\DashboardController@index')->name('dashboard');

Route::get('logout','Admin\SignupController@logout')->name('logout');

// Packages routes
Route::get('list-packages','Admin\Package\PackageController@packageList')->name('list-packages');
Route::get('edit-package/{package_id}','Admin\Package\PackageController@editPackage')->name('edit-package');

Route::post('update-package','Admin\Package\PackageController@updatePackage')->name('update-package');

Route::get('add-package','Admin\Package\PackageController@addPackage')->name('add-package');

Route::post('save-package','Admin\Package\PackageController@savePackage')->name('save-package');

Route::get('package-activation/{package_id}','Admin\Package\PackageController@packageActivation')->name('package-activation');

//filter package route
Route::get('filter-packages','Admin\Package\PackageController@filterPackages')->name('filter-packages');

//Worker Routes
Route::get('list-workers','Admin\Worker\WorkerController@workerList')->name('list-workers');

Route::get('edit-worker/{worker_id}','Admin\Worker\WorkerController@editWorker')->name('edit-worker');

Route::post('update-worker','Admin\Worker\WorkerController@updateWorker')->name('update-worker');

Route::get('add-worker','Admin\Worker\WorkerController@addWorker')->name('add-worker');

Route::post('save-worker','Admin\Worker\WorkerController@saveWorker')->name('save-worker');

Route::get('showfor-assign-order/{worker_id}','Admin\Worker\WorkerController@OrderstoWorker')->name('showfor-assign-order');

Route::post('assign-order-toworker','Admin\Worker\WorkerController@assignOrdertoWorker')->name('assign-order-toworker');

Route::get('view-worker-tasks/{worker_id}','Admin\Worker\WorkerController@viewWorkerTasks')->name('view-worker-tasks');

Route::get('filter-workers','Admin\Worker\WorkerController@filterWorker')->name('filter-workers');

Route::get('filter-orders-to-worker','Admin\Worker\WorkerController@filterOrdersToWorker')->name('filter-orders-to-worker');

Route::get('filter-assigned-order','Admin\Worker\WorkerController@filterAssignedOrder')->name('filter-assigned-order');

//users Routes
Route::get('user-list','Admin\User\UserController@userList')->name('user-list');

Route::get('view-user-orders/{user_id}','Admin\User\UserController@viewUserOrders')->name('view-user-orders');

Route::get('view-plant-profile/{user_id}','Admin\User\UserController@viewPlantProfile')->name('view-plant-profile');

Route::get('view-feedback/{order_id}','Admin\User\UserController@viewFeedback')->name('view-feedback');

Route::get('filter-user-list','Admin\User\UserController@filterUserList')->name('filter-user-list');

// orders detail modal ajex controller
Route::post('order-detail-modal','Admin\User\UserController@orderModal')->name('order-detail-modal');

Route::get('filter-user-orders','Admin\User\UserController@filterUserOrders')->name('filter-user-orders');

// orders route
Route::get('view-all-orders','Admin\Order\OrderController@viewallOrders')->name('view-all-orders');

Route::get('order-payment-done/{order_id}','Admin\Order\OrderController@orderPaymentStatus')->name('order-payment-done');

Route::get('order-status-done/{order_id}','Admin\Order\OrderController@orderStatus')->name('order-status-done');

Route::get('filter-order-list','Admin\Order\OrderController@filterOrderList')->name('filter-order-list');

//cleaning history routes

Route::get('cleaning-history','Admin\Cleaning\CleaningController@index')->name('cleaning-history');

Route::post('cleaning-history-filter','Admin\Cleaning\CleaningController@cleaningHistoryFilter')->name('cleaning-history-filter');

// payment hostory routes

Route::get('payment-history','Admin\Payment\PaymentController@index')->name('payment-history');



//Time sloat routes

Route::get('show-time-sloats','Admin\TimeSloat\TimeSloatController@viewTimeSloats')->name('show-time-sloats');

Route::get('slot-hide/{s_id}','Admin\TimeSloat\TimeSloatController@hideSloat')->name('slot-hide');

Route::get('slot-show/{s_id}','Admin\TimeSloat\TimeSloatController@showSloat')->name('slot-show');

Route::get('edit-time-slot','Admin\TimeSloat\TimeSloatController@editTimeSlot')->name('edit-time-slot');

Route::post('slot-save','Admin\TimeSloat\TimeSloatController@slotSave')->name('slot-save');

Route::get('delete-time-slot/{s_id}','Admin\TimeSloat\TimeSloatController@deleteTimeSlot')->name('delete-time-slot');

Route::get('add-time-slot','Admin\TimeSloat\TimeSloatController@addSlot')->name('add-time-slot');

Route::post('slot-update','Admin\TimeSloat\TimeSloatController@updateslot')->name('slot-update');

Route::get('filter-payment','Admin\Payment\PaymentController@filterPayment')->name('filter-payment');
