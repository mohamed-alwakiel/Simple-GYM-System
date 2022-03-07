<?php

use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\EmailVerificationController;
use App\Http\Controllers\Auth\VerificationController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });
Auth::routes(['verify'=> true]);
Route::post('login', action: [AuthController::class, 'login']);

Route::post('register', action: [AuthController::class, 'register']);

Route::post('email/verification-notification', [EmailVerificationController::class, 'resend'])->middleware('auth:sanctum');
Route::get('email/verify/{id}', [EmailVerificationController::class, 'verify'])->name('verification.verify');

Route::middleware('auth:sanctum')->group(function () {
    Route::post('logout', action: [AuthController::class, 'logout']);
    Route::get('users', action: [UserController::class, 'index']);
    Route::get('users/remainingSessions', action: [UserController::class, 'remainingSessions']);
    Route::get('show-sessions' ,action: [UserController::class , 'showAttendance']);
    Route::post('training-sessions/attend' ,action: [UserController::class , 'attend']);
    Route::get('showAttendanceHistory',action: [UserController::class ,'showAttendanceHistory']);
    Route::put('users', action: [UserController::class , 'update']);
});
