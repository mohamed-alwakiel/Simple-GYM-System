<?php

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
Route::get('/gymManagers', [GymManagersController::class, 'index'])->name('gymManagers.index')->middleware('auth');




// --------------- Cities
Route::get('/cities', [CitiesController::class, 'index'])->name('cities.index')->middleware('auth');
Route::get('/cities/create', [CitiesController::class, 'create'])->name('cities.create')->middleware('auth');
Route::post('/cities/store', [CitiesController::class, 'store'])->name('cities.store')->middleware('auth');
Route::get('/cities/edit/{city_id}', [CitiesController::class, 'edit'])->name('cities.edit')->middleware('auth');
Route::patch('/cities/update/{city_id}', [CitiesController::class, 'update'])->name('cities.update')->middleware('auth');
Route::delete('/cities/destroy/{city_id}', [CitiesController::class, 'destroy'])->name('cities.destroy')->middleware('auth');




// --------------- GYMS
Route::get('/gyms', [GymsController::class, 'index'])->name('gyms.index')->middleware('auth');
Route::get('/gyms/create', [GymsController::class, 'create'])->name('gyms.create')->middleware('auth');
Route::post('/gyms/store', [GymsController::class, 'store'])->name('gyms.store')->middleware('auth');
Route::get('/gyms/edit/{gym_id}', [GymsController::class, 'edit'])->name('gyms.edit')->middleware('auth');
Route::patch('/gyms/update/{gym_id}', [GymsController::class, 'update'])->name('gyms.update')->middleware('auth');
Route::delete('/gyms/destroy/{gym_id}', [GymsController::class, 'destroy'])->name('gyms.destroy')->middleware('auth');


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



