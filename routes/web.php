<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\DeviceController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SuspectController;
use App\Http\Controllers\DelegateUserController;
use App\Http\Controllers\GpsPositionController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\PolygonController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\LocationLogController;

use Illuminate\Http\Request;
use App\Exports\LocationLogsExport;
use Maatwebsite\Excel\Facades\Excel;


Route::get('/', function () {
    return view('welcome');
})->middleware('guest');

Auth::routes();


Route::get('/location-logs', [LocationLogController::class, 'index'])->name('location-logs.index');
Route::get('location-logs/export', function(Request $request) {
    $search = $request->query('search');
    $startDate = $request->query('start_date');
    $endDate = $request->query('end_date');
    return Excel::download(new LocationLogsExport($search, $startDate, $endDate), 'location_logs.xlsx');
})->name('location-logs.export');
Route::get('/location-logs/{id}', [LocationLogController::class, 'show'])->name('location-logs.show');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [UserController::class, 'editProfile'])->name('profile.edit');
    Route::put('/profile', [UserController::class, 'updateProfile'])->name('profile.update');
});



Route::get('/map', [AdminController::class, 'map'])->name('map');
Route::get('/search-suspects', [AdminController::class, 'searchSuspects'])->name('search.suspects');

Route::resource('devices', DeviceController::class);
Route::resource('users', UserController::class)->middleware('role:super');

Route::resource('delegate_users', DelegateUserController::class);
Route::resource('gps_positions', GpsPositionController::class);


Route::get('/device/{id}/details', [AdminController::class, 'deviceDetails'])->name('device.details');


Route::apiResource('polygons', PolygonController::class);

Route::get('/send-notification', [NotificationController::class, 'showNotificationForm'])->name('send.notification.form');
Route::post('/send-notification', [NotificationController::class, 'sendNotification'])->name('send.notification');

Route::resource('suspects', SuspectController::class);
Route::get('/get-cities/{state_id}', [SuspectController::class, 'getCities']);



Route::get('/session-test', function () {
    session(['test' => 'Laravel Session Test']);
    return session('test');
});





