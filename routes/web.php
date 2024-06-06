<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\DeviceController;

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

Route::get('/', function () {
    return view('welcome');
})->middleware('guest');

Route::fallback(function () {
   
});

Auth::routes();

//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::get('/map', [AdminController::class, 'map'])->name('map');
//Route::get('/register-devices', [AdminController::class, 'registerDevices'])->name('register_devices');
Route::get('/device-assignment', [AdminController::class, 'deviceAssignment'])->name('device_assignment');

Route::resource('devices', DeviceController::class);



