<?php

use App\Http\Controllers\GymManagerController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GymManagersController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\CitiesController;
use App\Http\Controllers\CityManagersController;
use App\Http\Controllers\GymsController;
use App\Http\Controllers\TrainingPackagesController;
use App\Http\Controllers\CoachController;
use App\Http\Controllers\BuyPackageController;
use App\Http\Controllers\TrainingSessionController;



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

Route::get('/', function () {
    return view('welcome');
});
// --------------- CITY MANAGERS
Route::get('/cityManagers', [CityManagersController::class, 'index'])->name('cityManagers.index')->middleware('auth');




// --------------- GYM MANAGERS
Route::middleware(['auth'])->group(function () {
    Route::GET('/gymManagers', [GymManagerController::class, 'index'])->name('gymManagers.index');

    Route::GET('/gymManagers/create', [GymManagerController::class, 'create'])->name('gymManagers.create');
    Route::POST('/gymManagers', [GymManagerController::class, 'store'])->name('gymManagers.store');

    // Route::GET('/posts/{post}', [PostController::class, 'show'])->name('posts.show');

    Route::GET('/gymManagers/{gymManagers}/edit', [GymManagerController::class, 'edit'])->name('gymManagers.edit');
    Route::PUT('/gymManagers/{gymManagers}', [GymManagerController::class, 'update'])->name('gymManagers.update');

    Route::DELETE('/gymManagers/{gymManagers}', [GymManagerController::class, 'destroy'])->name('gymManagers.destroy');
});



// --------------- Cities
Route::get('/cities', [CitiesController::class, 'index'])->name('cities.index')->middleware('auth');



// --------------- GYMS
Route::get('/gyms', [GymsController::class, 'index'])->name('gyms.index')->middleware('auth');



// --------------- Users
Route::get('/users', [UserController::class, 'index'])->name('users.index')->middleware('auth');



// --------------- Training Packages
Route::get('/trainingPackages', [TrainingPackagesController::class, 'index'])->name('trainingPackages.index')->middleware('auth');



// --------------- Sessions

Route::middleware(['auth'])->group(function () {
    Route::GET('/sessions', [TrainingSessionController::class, 'index'])->name('sessions.index');
    Route::GET('/sessions/create', [TrainingSessionController::class, 'create'])->name('sessions.create');
    Route::POST('/sessions', [TrainingSessionController::class, 'store'])->name('sessions.store');
    Route::GET('/sessions/{id}/edit', [TrainingSessionController::class, 'edit'])->name('sessions.edit');
    Route::PUT('/sessions/{id}', [TrainingSessionController::class, 'update'])->name('sessions.update');
    Route::DELETE('/sessions/{id}', [TrainingSessionController::class, 'destroy'])->name('sessions.destroy');
});



// --------------- Coaches
Route::middleware(['auth'])->group(function () {
    Route::GET('/coaches', [CoachController::class, 'index'])->name('coaches.index');
    Route::GET('/coaches/create', [CoachController::class, 'create'])->name('coaches.create');
    Route::POST('/coaches', [CoachController::class, 'store'])->name('coaches.store');
    Route::GET('/coaches/{id}/edit', [CoachController::class, 'edit'])->name('coaches.edit');
    Route::PUT('/coaches/{id}', [CoachController::class, 'update'])->name('coaches.update');
    Route::DELETE('/coaches/{id}', [CoachController::class, 'destroy'])->name('coaches.destroy');
});


// --------------- Attendance
Route::get('/attendance', [AttendanceController::class, 'index'])->name('attendance.index')->middleware('auth');



// --------------- Buy Package
Route::get('/buyPackage', [BuyPackageController::class, 'index'])->name('buyPackage.index')->middleware('auth');




Auth::routes();
Route::get('/dashboard', [App\Http\Controllers\HomeController::class, 'index'])->name('dashboard');

