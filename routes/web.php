<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\RoomCategoryController;
use App\Http\Controllers\AdvanceController;



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

Route::get('/advance/create/{booking_id}', [AdvanceController::class , 'create'])->name('advance.create');
Route::post('/advance/store', [AdvanceController::class,'store'])->name('advance.store');
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



        Route::controller(\App\Http\Controllers\BookingController::class)->group(function () {
            Route::get('/bookings', 'index')->name('index-booking');
            Route::get('/bookings/create', 'create')->name('create-booking');
            Route::post('/bookings', 'store')->name('store-booking');
            Route::post('/checkout', 'checkout')->name('checkout-booking');
            Route::get('/bookings/{id}', 'show')->name('show-booking');
            Route::get('/bookings/checkout/{id}', 'Bookingcheckout')->name('booking-checkout');
            Route::get('/checkoutcalculation', 'checkoutCal')->name('checkoutcalculation');
            Route::get('/getguestpreviousdetails', 'getguestpreviousdetails')->name('getguestpreviousdetails');
        });
        Route::resource('/category', RoomCategoryController::class);
        Route::resource('/room', RoomController::class);

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
