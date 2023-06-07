<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\Supplier\SupplierController;
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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

/************ Supplier API *********************/

// Route::group(['prefix' => 'supplier'], function () {
    
//      /* login api */
//     Route::post('login',[App\Http\Controllers\API\Supplier\SupplierController::class, 'login']);
    
//     /*Register api */ 
//     Route::post('signup', [App\Http\Controllers\API\Supplier\SupplierController::class, 'signup']);
    
//     /* Forgot password verify otp api*/
//     Route::post('forgot/email', [App\Http\Controllers\API\Supplier\SupplierController::class, 'sendverificationcode']);

//     /* Forgot password send otp api*/
//     Route::post('/forgot/verify/otp', [App\Http\Controllers\API\Supplier\SupplierController::class, 'verifyotp']);

//      /* Forgot password api*/
//     Route::post('forgot/password/change',[App\Http\Controllers\API\Supplier\SupplierController::class,'change_password']);


// });


     /* login api */
    Route::post('login',[App\Http\Controllers\API\Supplier\SupplierController::class, 'login']);
    
    /*Register api */ 
    Route::post('signup', [App\Http\Controllers\API\Supplier\SupplierController::class, 'signup']);
    
    /* Forgot password verify otp api*/
    Route::post('forgot/email', [App\Http\Controllers\API\Supplier\SupplierController::class, 'sendverificationcode']);

    /* Forgot password send otp api*/
    Route::post('/forgot/verify/otp', [App\Http\Controllers\API\Supplier\SupplierController::class, 'verifyotp']);

     /* Forgot password api*/
    Route::post('forgot/password/change',[App\Http\Controllers\API\Supplier\SupplierController::class,'change_password']);





Route::group(['middleware' => ['auth:api'],'prefix' => 'supplier'], function () {
    

     /*logout to customer*/ 
   // Route::post('logout', [App\Http\Controllers\API\Supplier\SupplierController::class, 'logout']);
    
    /* show details of users*/
    Route::get('profile', [App\Http\Controllers\API\Supplier\SupplierController::class, 'user']);
    
    // Route::post('delete', 'API\LoginController@delete_user');

    /* change password send otp api*/
    Route::post('varification', [App\Http\Controllers\API\Supplier\SupplierController::class, 'verificationcode']);

     /* Change password verifiy otp api*/
    Route::post('varifiy_otp', [App\Http\Controllers\API\Supplier\SupplierController::class, 'verify_otp']);

    /* change password after login */
    Route::post('change/password',[App\Http\Controllers\API\Supplier\SupplierController::class,'changepassword']);

    /* Edit profile api*/
    Route::post('edit', [App\Http\Controllers\API\Supplier\SupplierController::class, 'edituser']);

    /*Add offers*/
    Route::post('create/offers',[App\Http\Controllers\API\Supplier\OffersController::class,'store']);
    
    /*Offers list */
    Route::get('offers',[App\Http\Controllers\API\Supplier\OffersController::class,'view']);
    
    /*Search offers*/
    Route::get('search-result',[App\Http\Controllers\API\Supplier\OffersController::class,'get_search_result']);
    
    /*Inprocess bookings*/
    Route::get('/bookings/inprocess',[App\Http\Controllers\API\Supplier\BookingController::class,'inprocess_request']);
    
    /*Cancel bookings*/
    Route::get('/bookings/cancel',[App\Http\Controllers\API\Supplier\BookingController::class,'cancel_request']);
    
    /*Complete Booking*/
    Route::get('/bookings/complete',[App\Http\Controllers\API\Supplier\BookingController::class,'completed_request']);
    
    /*New booking requets*/
    Route::get('/bookings/new',[App\Http\Controllers\API\Supplier\BookingController::class,'new_request']);
    
    /*Fetch booking details*/
    Route::get('booking/detail/{id}',[App\Http\Controllers\API\Supplier\BookingController::class,'booking_detail']);
    
    /*Accept booking request*/
    Route::post('/booking/accept/{id}',[App\Http\Controllers\API\Supplier\BookingController::class,'accept_booking']);
    
    /*Cancel Booking request*/
    Route::post('/booking/cancel/{id}',[App\Http\Controllers\API\Supplier\BookingController::class,'cancel_booking']);

  
});



/************ Collector API *********************/

// Route::group(['prefix' => 'collector'], function () {
    
//      /* login api */
//     Route::post('login',[App\Http\Controllers\API\Collector\CollectorController::class, 'login']);
    
//     /*Register api */ 
//     Route::post('signup', [App\Http\Controllers\API\Collector\CollectorController::class, 'signup']);
    
//     /* Forgot password verify otp api*/
//     Route::post('forgot/email', [App\Http\Controllers\API\Collector\CollectorController::class, 'sendverificationcode']);

//     /* Forgot password send otp api*/
//     Route::post('/forgot/verify/otp', [App\Http\Controllers\API\Collector\CollectorController::class, 'verifyotp']);

//      /* Forgot password api*/
//     Route::post('forgot/password/change',[App\Http\Controllers\API\Collector\CollectorController::class,'change/password']);
// });

Route::group(['middleware' => ['auth:api']], function () {
    
      Route::post('logout', [App\Http\Controllers\API\Supplier\SupplierController::class, 'logout']);
      Route::get('user/profile/{id}', [App\Http\Controllers\API\UserController::class, 'user_details']);
      
});

Route::group(['middleware' => ['auth:api'],'prefix' => 'collector'], function () {
    

     /*logout to customer*/ 
   // Route::post('logout', [App\Http\Controllers\API\Collector\CollectorController::class, 'logout']);
    
    /* show details of users*/
    Route::get('profile', [App\Http\Controllers\API\Collector\CollectorController::class, 'user']);
    
    // Route::post('delete', 'API\LoginController@delete_user');

    /* change password send otp api*/
    Route::post('varification', [App\Http\Controllers\API\Collector\CollectorController::class, 'verificationcode']);

     /* Change password verifiy otp api*/
    Route::post('varifiy_otp', [App\Http\Controllers\API\Collector\CollectorController::class, 'verify_otp']);

    /* change password after login */
    Route::post('change/password',[App\Http\Controllers\API\Collector\CollectorController::class,'changepassword']);

    /* Edit profile api*/
    Route::post('edit', [App\Http\Controllers\API\Collector\CollectorController::class, 'edituser']);

    Route::post('booking/request',[App\Http\Controllers\API\Collector\BookingController::class,'store']);

    Route::get('users',[App\Http\Controllers\API\Collector\BookingController::class,'getsuppliers']);

    Route::get('offers/{id}',[App\Http\Controllers\API\Collector\BookingController::class,'supplierid']);

      // Route::get('booking/detail/{id}',[App\Http\Controllers\API\Collector\BookingController::class,'getselecteddata']);

    Route::get('/complete/appointments',[App\Http\Controllers\API\Collector\BookingController::class,'complete_appointment']);

    Route::get('upcoming/appointments',[App\Http\Controllers\API\Collector\BookingController::class,'upcoming_appointment']);

    Route::get('appointment/detail/{id}',[App\Http\Controllers\API\Collector\BookingController::class,'getselecteddata']);

    Route::post('reschedule/appointment/{id}',[App\Http\Controllers\API\Collector\BookingController::class,'updateavals']);

    Route::post('complete/appointment/{id}',[App\Http\Controllers\API\Collector\BookingController::class,'complete_booking']);

      
    // /*Fetch notifications */
    // Route::get('notifications', [App\Http\Controllers\API\Collector\CollectorController::class, 'notifications']);

    // /* Delete notification*/
    // Route::get('remove_notification', [App\Http\Controllers\API\Collector\CollectorController::class, 'delnotifications']);

    // /* Refresh firebase device token */
    // Route::post('on_token_refresh', [App\Http\Controllers\API\Collector\CollectorController::class, 'firebase_refresh_token']);

});



