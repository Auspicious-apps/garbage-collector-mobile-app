<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\SupplierController;
use App\Http\Controllers\Admin\CollectorController;
use App\Http\Controllers\Admin\MyAccountController;
use App\Http\Controllers\Admin\BookingController;
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

// Route::get('/', function () {
//     return view('welcome');
// });

// Auth::routes();

// Route::get('/home', 'HomeController@index')->name('home');
Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
// Route::prefix('admin')->middleware(['auth','isAdmin'])->group(function(){
    
// });

Route::group(['middleware' => 'admin'], function () {
    Route::get('/admin',[App\Http\Controllers\Admin\AdminController::class,'dashboard']);

      

    //SupplierController
    Route::get('/supplierprofilelist',[App\Http\Controllers\Admin\SupplierController::class,'index']);  
    Route::get('supplierprofile/{id}',[App\Http\Controllers\Admin\SupplierController::class,'view']);    
      Route::post('delete-collector',[App\Http\Controllers\Admin\CollectorController::class,'deleteuser']);    


    //CollectorController
    Route::get('collectorprofile/{id}',[App\Http\Controllers\Admin\CollectorController::class,'view']);
     Route::get('collectorprofilelist',[App\Http\Controllers\Admin\CollectorController::class,'index']);
     Route::post('delete-supplier',[App\Http\Controllers\Admin\SupplierController::class,'deleteuser']);


    //MyAccountController
    Route::get('/myaccount',[App\Http\Controllers\Admin\MyAccountController::class,'myaccount']);
    Route::post('/myaccount/{id}',[App\Http\Controllers\Admin\MyAccountController::class,'store']);

    //BookingController
    Route::get('/bhistory',[App\Http\Controllers\Admin\BookingController::class,'bhistory']);
      // Route::get('/booking',[App\Http\Controllers\Admin\BookingController::class,'
      //   booking_data']);
   // Route::get('/booking', 'Admin\BookingController@booking_data');

     Route::get('/booking-history-detail/{id}',[App\Http\Controllers\Admin\BookingController::class,'view']);
      Route::get('/sbooking-history-detail/{id}',[App\Http\Controllers\Admin\BookingController::class,'sview']);
        Route::post('/delete-booking',[App\Http\Controllers\Admin\BookingController::class,'deletebooking']);
        Route::get('/data',[App\Http\Controllers\Admin\BookingController::class,'index']);
});