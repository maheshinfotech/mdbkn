<?php

use Illuminate\Support\Facades\Route;

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

Route::prefix(config('app.admin_prefix'))->group(function () {

    Route::middleware(['auth', 'shareview'])->group(function () {

        Route::get('/welcome' , function(){

            return view('pages.guest-page');

        })->name('welcome');

        Route::get('/', function () {

            return redirect()->route('dashboard');

        });

        Route::view('site-settings' , 'pages.site-settings');

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

        Route::controller(\App\Http\Controllers\GroupController::class)->group(function () {

            Route::get('/groups', 'index')->name('index-group');
            
            Route::get('/manage-group/{group_placeholder?}', 'showForm')->name('show-group');
            
            Route::get('/toggle-group-status/{group_placeholder}', 'toggleStatus')->name('toggle-group-status');
            
            Route::post('/manage-group', 'manage')->name('create-group');
            
            Route::put('/manage-group/{group_placeholder}', 'manage')->name('update-group');
            
            Route::delete('/group/{group_placeholder}', 'delete')->name('delete-group');
            
        });
        
        Route::controller(\App\Http\Controllers\MachineryController::class)->group(function () {
            
            Route::get('/machinery', 'index')->name('index-machinery');
            
            Route::get('/manage-machinery/{machinery_placeholder?}', 'showForm')->name('show-machinery');
            
            Route::post('/manage-machinery', 'manage')->name('create-machinery');
            
            Route::get('/toggle-machine-status/{machine_placeholder}', 'toggleStatus')->name('toggle-machine-status');
            
            Route::put('/manage-machinery/{machinery_placeholder}', 'manage')->name('update-machinery');
            
            Route::delete('/machinery/{machinery_placeholder}', 'delete')->name('delete-machinery');

            Route::get('/fuel-consumption-reading' , 'fuelConsumptionReading')->name('fuel-consumption-reading-listing');
            
            Route::get('/machine-working-hours' , 'machineWorkingHours')->name('machine-working-hours-listing');

            /**Backend Edit */

            Route::get('/manage-machine-working-hours/{id}' , 'showMachineWorkingHour')->name('show-machine-working-hours');

            Route::post('/manage-machine-working-hours/{id}' , 'updateMachineWorkingHour')->name('update-machine-working-hours');

            Route::get('/manage-fuel-consumption-reading/{id}' , 'showFuelReading')->name('show-fuel-reading');

            Route::post('/manage-fuel-consumption-reading/{id}' , 'updateFuelReading')->name('update-fuel-reading');
            
            /**End */
            
            Route::get('/machine-fuel-summary' , 'machineFuelSummary')->name('machine-fuel-summary');
           
            Route::get('/group-fuel-summary' , 'groupFuelSummary')->name('group-fuel-summary');
            
            Route::get('/monthly-report' , 'monthlyReport')->name('monthly-report');

            /**Mass Insert through excel file */

            Route::get('/manage-fuel-consumption-reading' , 'createFuelReading')->name('create-fuel-reading');
            
            Route::get('/manage-machine-working-hours' , 'createMachineHours')->name('create-machine-hours');
            
            Route::post('/mass-insert-fuel-reading' , 'massInsertFuelConsumption')->name('mass-insert-fuel-reading');

            Route::post('/mass-insert-machine-hours' , 'massInsertMachineHours')->name('mass-insert-machine-hours');

            /**End */
            
        });

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