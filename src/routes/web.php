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

Route::get('attendance', [AttendanceController::class, 'attendance']);
Route::get('list', [AttendanceController::class, 'list']);
Route::get('detail', [AttendanceController::class, 'detail']);
Route::post('request', [RequestController::class, 'list']);

// Route::get('/', function () {
//     return view('welcome');
// });
