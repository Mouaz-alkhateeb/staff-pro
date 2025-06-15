<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CityController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\MediaController;
use App\Http\Controllers\NationalityController;
use App\Http\Controllers\PermissionGroupController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserStatusController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::group(['prefix' => 'auth'], function () {
    Route::post('login', [AuthController::class, 'login']);
    Route::post('register', [AuthController::class, 'register']);
});

Route::middleware(['auth:sanctum'])->group(function () {

    Route::group(['prefix' => 'auth'], function () {
        Route::post('changePassword', [AuthController::class, 'changePassword']);
        Route::post('resetPassword', [AuthController::class, 'resetPassword']);
        Route::post('logout', [AuthController::class, 'logout']);
    });

    Route::group(['prefix' => 'user', 'controller' => UserController::class], function () {
        Route::get('/', 'index')->middleware('permission:user_list');
        Route::get('/getUserList', 'getUserList')->middleware('permission:user_list');
        Route::put('/{id}/changeUserStatus', 'changeUserStatus')->middleware('permission:user_edit');
        Route::post('/', 'store')->middleware('permission:user_create');
        Route::put('/{id}', 'update')->middleware('permission:user_edit');
        Route::get('/{id}', 'show')->middleware('permission:user_show');
        Route::delete('/{id}', 'destroy');
    });

    Route::group(['prefix' => 'city', 'controller' => CityController::class], function () {
        Route::get('/', 'index')->middleware('permission:city_list');
        Route::post('/', 'store')->middleware('permission:city_create');
        Route::get('/{id}', 'show')->middleware('permission:city_show');
        Route::put('/{id}', 'update')->middleware('permission:city_edit');
        Route::get('getCitiesList', 'getCitiesList')->middleware('permission:city_list');
        Route::delete('/{id}', 'destroy');
    });

    Route::group(['prefix' => 'room', 'controller' => RoomController::class], function () {
        Route::get('/', 'index')->middleware('permission:room_list');
        Route::get('/getRoomList', 'getRoomList')->middleware('permission:room_list');
        Route::post('/', 'store')->middleware('permission:room_create');
        Route::put('/{id}', 'update')->middleware('permission:room_edit');
        Route::get('/{id}', 'show')->middleware('permission:room_show');
        Route::delete('/{id}', 'destroy');
    });

    Route::group(['prefix' => 'department', 'controller' => DepartmentController::class], function () {
        Route::get('/', 'index')->middleware('permission:department_list');
        Route::get('/getDepartmentsList', 'getDepartmentList')->middleware('permission:department_list');
        Route::post('/', 'store')->middleware('permission:department_create');
        Route::put('/{id}', 'update')->middleware('permission:department_edit');
        Route::get('/{id}', 'show')->middleware('permission:department_show');
        Route::delete('/{id}', 'destroy');
    });

    Route::group(['prefix' => 'userstatus', 'controller' => UserStatusController::class], function () {
        Route::get('/', 'index')->middleware('permission:user_status_list');
        Route::get('/getStatusList', 'getStatusList')->middleware('permission:user_status_list');
        Route::post('/', 'store')->middleware('permission:user_status_create');
        Route::put('/{id}', 'update')->middleware('permission:user_status_edit');
        Route::get('/{id}', 'show')->middleware('permission:user_status_show');
        Route::delete('/{id}', 'destroy');
    });

    Route::group(['prefix' => 'nationality', 'controller' => NationalityController::class], function () {
        Route::get('/', 'index')->middleware('permission:nationality_list');
        Route::get('/getNationalitiesList', 'getNationalitiesList')->middleware('permission:nationality_list');
        Route::post('/', 'store')->middleware('permission:nationality_create');
        Route::put('/{id}', 'update')->middleware('permission:nationality_edit');
        Route::get('/{id}', 'show')->middleware('permission:nationality_show');
        Route::delete('/{id}', 'destroy');
    });

    Route::group(['prefix' => 'media', 'controller' => MediaController::class], function () {
        Route::post('/uploadFiles', 'store')->middleware('permission:media_create');
        Route::get('/getFiles', 'getFiles')->middleware('permission:media_list');
        Route::delete('/deleteFile/{id}', 'delete')->middleware('permission:media_edit');
    });


    Route::group(['prefix' => 'role', 'controller' => RoleController::class], function () {
        Route::get('/', 'index')->middleware('permission:role_list');
        Route::get('/{id}', 'show')->middleware('permission:role_show');
        Route::post('/', 'store')->middleware('permission:role_create');
        Route::put('/{id}/updateRolePermissions', 'updateRolePermissions')->middleware('permission:role_edit');
        Route::delete('/{id}', 'destroy')->middleware('permission:role_delete');
    });

    Route::group(['prefix' => 'permissionGroup', 'controller' => PermissionGroupController::class], function () {
        Route::get('/getPermissionGroupsList', 'getPermissionGroupsList');
    });
});
