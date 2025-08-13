<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AttendanceController;
use app\Http\Controllers\RequestController;

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

// Route::get('register', [AuthController::class, 'register']);
// Route::post('register', [AuthController::class, 'registerPost']);
// Route::get('login', [AuthController::class, 'login']);
// Route::post('login', [AuthController::class, 'loginPost']);

Route::group(['middleware' => 'auth'], function () {
    Route::get('attendance', [AttendanceController::class, 'attendance']);
    Route::get('/attendance/clock_in', [AttendanceController::class, 'clockIn']);
    Route::get('/attendance/clock_out', [AttendanceController::class, 'clockOut']);
    Route::get('/attendance/rest_start', [AttendanceController::class, 'restStart']);
    Route::get('/attendance/rest_end', [AttendanceController::class, 'restEnd']);
    Route::get('/attendance/list', [AttendanceController::class, 'list']);
    Route::get('/attendance/{id}', [AttendanceController::class, 'detail']);
    Route::post('/stamp_correction_request/list', [RequestController::class, 'list']);
});




Route::post('/attendance/break-start', [AttendanceController::class, 'breakStart'])
    ->name('attendance.breakStart');

// Route::get('/', function () {
//     return view('welcome');
// });
