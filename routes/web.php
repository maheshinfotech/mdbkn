<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\GroupController;
use App\Http\Controllers\AdvanceController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\HospitalController;
use App\Http\Controllers\RoomCategoryController;



/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Example Routes

//Route::post('/advances/store', [AdvanceController::class,'store'])->name('advances.store');
Route::get('/storagelink', function(){
    // dd(new Artisan);
    \Illuminate\Support\Facades\Artisan::call('storage:link');

    // exec('composer update my-package');

});
Route::get('/advance/create/{booking_id}', [AdvanceController::class , 'create'])->name('advance.create');
Route::post('/advance/store', [AdvanceController::class,'store'])->name('advance.store');
//Route::get('/booking/more-than/{days}', [BookingController::class, 'showMoreThan']);
Route::get('/booking/more', [BookingController::class, 'morePage'])->name('booking.more');
Route::get('/billing/show/{booking_id}', [BookingController::class,'billingShow'])->name('billing.show');


//
// Route::get('/advance/show/{booking_id}', [AdvanceController::class .'show'])->name('advance.show');
// Route::get('migrate', function(){
//     // \Illuminate\Support\Facades\Artisan::call('migrate');
//     // dd(new Artisan);
//     exec('composer update my-package');

// });
Route::prefix(config('app.admin_prefix'))->group(function () {

    Route::middleware(['auth', 'shareview'])->group(function () {

        Route::get('/welcome', function () {

            return view('pages.guest-page');
        })->name('welcome');

        Route::get('/', function () {

            return redirect()->route('dashboard');
        });

        Route::view('site-settings', 'pages.site-settings');

        Route::controller(\App\Http\Controllers\RoleController::class)->group(function () {

            Route::get('/roles', 'index')->name('index-role');

            Route::get('/manage-role/{role_placeholder?}', 'showForm')->name('show-role');

            Route::post('/manage-role', 'manage')->name('create-role');

            Route::get('/toggle-role-status/{role_placeholder}', 'toggleStatus')->name('toggle-role-status');

            Route::put('/manage-role/{role_placeholder}', 'manage')->name('update-role');

            Route::delete('/role/{role_placeholder}', 'delete')->name('delete-role');
        });

        Route::controller(\App\Http\Controllers\DashboardController::class)->group(function () {
            Route::get('/dashboard', 'index')->name('dashboard');
            Route::get('/booking/check','booking_check')->name('booking.check');
        });

        Route::controller(\App\Http\Controllers\UserController::class)->group(function () {

            Route::get('/users', 'index')->name('index-user');

            Route::get('/manage-user/{user_placeholder?}', 'showForm')->name('show-user');

            Route::post('/manage-user', 'manage')->name('create-user');

            Route::put('/manage-user/{user_placeholder}', 'manage')->name('update-user');

            Route::delete('/user/{user_placeholder}', 'delete')->name('delete-user');

            Route::post('/update-user-password', 'updatePassword')->name('manage-user-password');

            Route::post('/update-profile', 'updateProfile')->name('update-profile');

            Route::get('/update-profile', 'viewUpdatePassword')->name('view-update-profile');

            Route::post('/change-user-status/{id}', 'changeUserStatus')->name('manage-user-status');

            Route::get('/toggle-user-status/{user_placeholder}', 'toggleStatus')->name('toggle-user-status');
        });

        Route::controller(\App\Http\Controllers\MenuController::class)->group(function () {

            Route::get('/permissions', 'permissionPage')->name('show-permission');

            Route::post('/permissions', 'setPermissions')->name('set-permission');
        });
        Route::resource('/groups',GroupController::class);

        Route::controller(\App\Http\Controllers\BookingController::class)->group(function () {

            Route::get('/bookings', 'index')->name('index-booking');
            Route::get('/bookings/create', 'create')->name('create-booking');
            Route::post('/bookings', 'store')->name('store-booking');
            Route::post('/checkout', 'checkout')->name('checkout-booking');
            Route::get('/todaycheckout', 'todaycheckout')->name('todaycheckout');
            Route::get('/balancedue', 'balancedue')->name('balancedue');
            Route::get('/bookings/{id}', 'show')->name('show-booking');
            Route::get('/bookings/edit/{id}', 'edit')->name('edit-booking');
            Route::post('/bookings/update/{id}', 'update')->name('update-booking');
            Route::get('/bookings/checkout/{id}', 'Bookingcheckout')->name('booking-checkout');
            Route::get('/checkoutcalculation', 'checkoutCal')->name('checkoutcalculation');
            Route::get('/getguestpreviousdetails', 'getguestpreviousdetails')->name('getguestpreviousdetails');
            Route::get('/booking/index', [BookingController::class,'showBookings'])->name('bookings.index');
            Route::post('/save-parking-data/{id}', 'BookingController@Bookingcheckout')->name('saveParkingData');
            Route::get('/today-bookings', [BookingController::class, 'showTodayBookings'])->name('today-bookings');
            Route::get('/datebooking/filter', [BookingController::class ,'filterByDate'])->name('datebooking.filter');
            Route::post('/getBookedRoomsCount', [BookingController::class, 'getBookedRoomsCount'])->name('getBookedRoomsCount');
            Route::post('/getBookedRoomsDetails', [BookingController::class, 'getBookedRoomsDetails'])->name('getBookedRoomsDetails');
            

             Route::delete('/hospital/delete/{id}', [HospitalController::class,'destroy'])->name('hospital.delete');
             Route::post('/hospital/store', [HospitalController::class, 'store'])->name('hospital.store');
             Route::get('/hospital/edit/{id}', [HospitalController::class, 'edit']);
               Route::put('/hospital/update/{id}', [HospitalController::class ,'update'])->name('hospital.update');





            // Route::get('/tesesms', [BookingController::class, 'test'])->name('test');
            // Example Route
              Route::get('/get-wards', [HospitalController::class ,'getWards']);
              Route::get('/hospitals', [HospitalController::class ,'index']);




            Route::get('/test', [BookingController::class, 'test']);

            /**Parking Module */
            Route::get('/parkings', 'parkings')->name('parkings');
            Route::post('/add-parking', 'addParking')->name('add-parking');
            Route::post('/clear-parking', 'clearParking')->name('clear-parking');
            Route::post('/parking-fetch-charge', 'parkingFetchCharge')->name('parking-fetch-charge');

        });

        Route::resource('/category', RoomCategoryController::class);
        Route::resource('/room', RoomController::class);
        // Route::get('/room/unbooked', [RoomController::class, 'unbookedRooms']);

        Route::get('/Available-rooms', [RoomController::class ,'AvailableRooms'])->name('Available-rooms');
        Route::get('/booked-rooms', [RoomController::class ,'bookedRooms'])->name('booked-rooms');
        Route::get('/rooms/initial', [RoomController::class ,'showInitialRooms'])->name('rooms.initial');
        Route::get('/rooms/basic', [RoomController::class ,  'showBasicRooms'])->name('rooms.basic');
        Route::get('/rooms/normal', [RoomController::class, 'showNormalRooms'])->name('rooms.normal');
        Route::get('/rooms/premium', [RoomController::class ,'showPremiumRooms'])->name('rooms.premium');
        Route::get('/rooms/flats', [RoomController::class ,'showflatsRooms'])->name('rooms.flats');
        Route::get('/rooms/other', [RoomController::class ,'showotherRooms'])->name('rooms.other');

        Route::get('logout', [\App\Http\Controllers\AuthController::class, 'logout'])->name('logout');

        Route::view('guest', 'pages.guest-page');
    });

    Route::middleware('guest')->group(function () {

        Route::controller(\App\Http\Controllers\AuthController::class)->group(function () {

            Route::get('/login', 'loginView')->name('loginView');

            Route::post('/login', 'login')->name('login');

            Route::get('/forgot-password', 'forgotPasswordView')->name('forgotPassword');

            Route::post('/forgot-password', 'forgotPasswordEmail');

            Route::get('/reset-password/{id}', 'resetPasswordView');

            Route::post('/reset-password/{id}', 'resetPassword');

        });
    });
});
