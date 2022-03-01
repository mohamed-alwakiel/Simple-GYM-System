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
use App\Http\Controllers\CoachesController;
use App\Http\Controllers\BuyPackageController;
use App\Http\Controllers\SessionsController;



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

Auth::routes();
Route::get('/dashboard', [App\Http\Controllers\HomeController::class, 'index'])->name('dashboard');

// --------------- CITY MANAGERS
Route::get('/cityManagers', [CityManagersController::class, 'index'])->name('cityManagers.index')->middleware('auth');




// --------------- GYM MANAGERS
Route::middleware(['auth'])->group(function () {
    Route::GET('/gymManagers', [GymManagerController::class, 'index'])->name('gymManagers.index');

    Route::GET('/gymManagers/create', [GymManagerController::class, 'create'])->name('gymManagers.create');
    Route::POST('/gymManagers', [GymManagerController::class, 'store'])->name('gymManagers.store');

    // Route::GET('/posts/{post}', [PostController::class, 'show'])->name('posts.show');

    Route::GET('/gymManagers/{gymManager}/edit', [GymManagerController::class, 'edit'])->name('gymManagers.edit');
    Route::PUT('/gymManagers/{gymManager}', [GymManagerController::class, 'update'])->name('gymManagers.update');

    Route::DELETE('/gymManagers/{gymManager}', [GymManagerController::class, 'destroy'])->name('gymManagers.destroy');
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
Route::get('/sessions', [SessionsController::class, 'index'])->name('sessions.index')->middleware('auth');



// --------------- Coaches
Route::get('/coaches', [CoachesController::class, 'index'])->name('coaches.index')->middleware('auth');



// --------------- Attendance
Route::get('/attendance', [AttendanceController::class, 'index'])->name('attendance.index')->middleware('auth');



// --------------- Buy Package
Route::get('/buyPackage', [BuyPackageController::class, 'index'])->name('buyPackage.index')->middleware('auth');
