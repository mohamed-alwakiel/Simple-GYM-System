<?php

use App\Http\Controllers\GymManagerController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\CitiesController;
use App\Http\Controllers\CityManagerController;
use App\Http\Controllers\GymsController;
use App\Http\Controllers\TrainingPackageController;
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
Route::middleware(['auth'])->group(function () {
    Route::GET('/cityManagers', [CityManagerController::class, 'index'])->name('cityManagers.index');

    Route::GET('/cityManagers/create', [CityManagerController::class, 'create'])->name('cityManagers.create');
    Route::POST('/cityManagers', [CityManagerController::class, 'store'])->name('cityManagers.store');

    // Route::GET('/posts/{post}', [PostController::class, 'show'])->name('posts.show');

    Route::GET('/cityManagers/{cityManager}/edit', [CityManagerController::class, 'edit'])->name('cityManagers.edit');
    Route::PUT('/cityManagers/{cityManager}', [CityManagerController::class, 'update'])->name('cityManagers.update');

    Route::DELETE('/cityManagers/{cityManager}', [CityManagerController::class, 'destroy'])->name('cityManagers.destroy');
});


// --------------- GYM MANAGERS
Route::middleware(['auth'])->group(function () {
    Route::GET('/gymManagers', [GymManagerController::class, 'index'])->name('gymManagers.index');

    Route::GET('/gymManagers/create', [GymManagerController::class, 'create'])->name('gymManagers.create');
    Route::POST('/gymManagers', [GymManagerController::class, 'store'])->name('gymManagers.store');

    Route::GET('/gymManagers/{gymManager}/edit', [GymManagerController::class, 'edit'])->name('gymManagers.edit');
    Route::PUT('/gymManagers/{gymManager}', [GymManagerController::class, 'update'])->name('gymManagers.update');

    Route::DELETE('/gymManagers/{gymManager}', [GymManagerController::class, 'destroy'])->name('gymManagers.destroy');
});


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
Route::middleware(['auth'])->group(function () {
    Route::GET('/users', [UserController::class, 'index'])->name('users.index');
    Route::GET('/users/create', [UserController::class, 'create'])->name('users.create');
    Route::get('/json-gym',[UserController::class,'GetGymNameFromCityName']);
    Route::GET('/users/{data}/edit', [UserController::class, 'edit'])->name('users.edit');
    Route::POST('/users', [UserController::class, 'store'])->name('users.store');
    // Route::GET('/users/{user}', [PostController::class, 'show'])->name('users.show');
    Route::PUT('/users/{user}', [UserController::class, 'update'])->name('users.update');

    Route::DELETE('/users/{user}', [UserController::class, 'destroy'])->name('users.destroy');




});






// --------------- Training Packages
Route::group(['middleware' => ['auth'] ], function() {

Route::get('/trainingPackages', [TrainingPackageController::class, 'index'])->name('trainingPackages.index');
Route::get('/trainingPackages/create',[TrainingPackageController::class, 'create'])->name('trainingPackages.create');
Route::get('/trainingPackages/{package}', [TrainingPackageController::class, 'show'])->name('trainingPackages.show');
Route::get('/trainingPackages/{package}/edit',[TrainingPackageController::class, 'edit'])->name('trainingPackages.edit');
Route::put('/trainingPackages/{package}',[TrainingPackageController::class, 'update'])->name('trainingPackages.update');
Route::post('/trainingPackages',[TrainingPackageController::class, 'store'])->name('trainingPackages.store');
Route::delete('/trainingPackages/{package}',[TrainingPackageController::class, 'destroy'])->name('trainingPackages.destroy');

});

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

