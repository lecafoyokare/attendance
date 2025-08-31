<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\CorrectionController;
use App\Http\Controllers\RequestController;
use App\Models\Attendance;
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

Route::get('/admin/login', [AdminController::class, 'login'])->name('admin.login');

Route::group(['middleware' => ['auth', 'verified']], function () {
    Route::get('attendance', [AttendanceController::class, 'attendance'])->middleware('home')->name('attendance');
    Route::post('/attendance/clock_in', [AttendanceController::class, 'clockIn']);
    Route::post('/attendance/clock_out', [AttendanceController::class, 'clockOut']);
    Route::post('/attendance/rest_start', [AttendanceController::class, 'restStart']);
    Route::post('/attendance/rest_end', [AttendanceController::class, 'restEnd']);
    Route::get('/attendance/list', [AttendanceController::class, 'list']);
    Route::get('/attendance/list/{year?}/{month?}', [AttendanceController::class, 'list'])->name('list.byMonth');
    Route::get('/csv-download', [AttendanceController::class, 'downloadCsv']);
    Route::get('/attendance/{id}', [AttendanceController::class, 'detail']);
    Route::post('/correction/update', [CorrectionController::class, 'update']);
    Route::get('/stamp_correction_request/list', [RequestController::class, 'waitingList'])->middleware('redirectIfAdmin');
    Route::get('/stamp_correction_request/list/approved', [RequestController::class, 'approvedList'])->middleware('redirectIfAdmin');
});

Route::group(['middleware' => ['auth', 'verified','admin']], function () {
    Route::get('/admin/attendance/list/{year?}/{month?}/{day?}', [AdminController::class, 'list'])->name('admin.list');
    Route::get('/admin/staff/list', [AdminController::class, 'staffList']);
    Route::get('/admin/attendance/staff/{id}/{year?}/{month?}', [AdminController::class, 'staffAttendance'])->name('admin.attendance.staff');
    Route::get('/admin/stamp_correction_request/list', [RequestController::class, 'adminWaitingList']);
    Route::get('/admin/stamp_correction_request/list/approved', [RequestController::class, 'adminApprovedList']);
    Route::get('/admin/stamp_correction_request/approve/{attendance_correct_request}', [RequestController::class, 'approve']);
    Route::post('/admin/stamp_correction_request/approve', [RequestController::class, 'approveProcess']);
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
