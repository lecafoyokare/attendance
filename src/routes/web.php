<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\RequestController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;

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

Route::group(['middleware' => ['auth', 'verified']], function () {
    Route::get('attendance', [AttendanceController::class, 'attendance']);
    Route::get('/attendance/clock_in', [AttendanceController::class, 'clockIn']);
    Route::get('/attendance/clock_out', [AttendanceController::class, 'clockOut']);
    Route::get('/attendance/rest_start', [AttendanceController::class, 'restStart']);
    Route::get('/attendance/rest_end', [AttendanceController::class, 'restEnd']);
    Route::get('/attendance/list', [AttendanceController::class, 'list']);
    Route::get('/attendance/list/{year?}/{month?}', [AttendanceController::class, 'list'])->name('list.byMonth');
    Route::get('/attendance/{id}', [AttendanceController::class, 'detail']);
    // Route::post('/stamp_correction_request/list', [RequestController::class, 'list']);
});

Route::get('/email/verify', function () {
    return view('Auth.verify-email');
})->middleware('auth')->name('verification.notice');

Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();
    return back()->with('message', 'Verification link sent!');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');

Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();
    return redirect('/attendance');
})->middleware(['auth', 'signed'])->name('verification.verify');
