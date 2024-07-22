<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DeviceController;
use App\Http\Controllers\AlertController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\SuspectAuthController;
use App\Http\Controllers\SuspectController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});



Route::get('/devices/locations', [DeviceController::class, 'getLocations']);
Route::get('/alerts/counts', [AlertController::class, 'counts']);
Route::post('/devices/{serial}/location', [DeviceController::class, 'updateLocation']);

Route::post('login', [AuthController::class, 'login']);
Route::post('logout', [AuthController::class, 'logout'])->middleware('auth:api');
Route::post('refresh', [AuthController::class, 'refresh'])->middleware('auth:api');
Route::post('me', [AuthController::class, 'me'])->middleware('auth:api');




Route::post('/send-notification', [NotificationController::class, 'sendPushNotification']);
Route::post('/notifications/read', [NotificationController::class, 'markAsRead']);
Route::post('/notifications', [NotificationController::class, 'getNotifications']);

//Route::post('/register-device', [DeviceController::class, 'registerDevice'])->middleware('auth:api');
Route::middleware('auth:suspect')->group(function () {
    Route::post('/register-device', [DeviceController::class, 'registerDevice']);
});

/* Route::post('/suspect/register', [SuspectAuthController::class, 'register']);
Route::post('/suspect/login', [SuspectAuthController::class, 'login']);
Route::middleware('auth:sanctum')->get('/suspect', [SuspectAuthController::class, 'suspect']); */

Route::post('/suspect/register', [SuspectAuthController::class, 'register']);
Route::post('/suspects/reset-password', [SuspectController::class, 'resetPassword']);
Route::post('/suspect/login', [SuspectAuthController::class, 'login']);
Route::middleware(['custom.auth:suspect', 'handle.jwt.exceptions'])->group(function () {
    Route::get('/suspect', [SuspectAuthController::class, 'suspect']);
    Route::post('/suspect/logout', [SuspectAuthController::class, 'logout']);
    Route::post('/suspect/refresh', [SuspectAuthController::class, 'refresh']);
    
});
