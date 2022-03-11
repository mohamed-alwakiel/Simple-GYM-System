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
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\RevenueController;
use App\Http\Controllers\StripeController;
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

Route::GET('/', [HomeController::class, 'index'])->name('dashboard');


// --------------- Auth -> Login & Register
Auth::routes();
Route::GET('/dashboard', [App\Http\Controllers\HomeController::class, 'index'])->name('dashboard');




// --------------- CITY MANAGERS
Route::group(['middleware' => 'auth', 'middleware' => 'role:admin'], function () {
    Route::GET('/cityManagers', [CityManagerController::class, 'index'])->name('cityManagers.index');
    Route::GET('/cityManagers/create', [CityManagerController::class, 'create'])->name('cityManagers.create');
    Route::GET('/cityManagers/{id}', [CityManagerController::class, 'show'])->name('cityManagers.show');
    Route::POST('/cityManagers', [CityManagerController::class, 'store'])->name('cityManagers.store');
    Route::GET('/cityManagers/edit/{cityManager}', [CityManagerController::class, 'edit'])->name('cityManagers.edit');
    Route::PUT('/cityManagers/{cityManager}', [CityManagerController::class, 'update'])->name('cityManagers.update');
    Route::DELETE('/cityManagers/{cityManager}', [CityManagerController::class, 'destroy'])->name('cityManagers.destroy');
});


// --------------- GYM MANAGERS
Route::group(['middleware' => 'auth', 'middleware' => 'role:admin|cityManager'], function () {
    Route::GET('/gymManagers', [GymManagerController::class, 'index'])->name('gymManagers.index');
    Route::GET('/gymManagers/banned', [GymManagerController::class, 'banView'])->name('gymManagers.banned');    // show banned Mgr
    Route::GET('/gymManagers/create', [GymManagerController::class, 'create'])->name('gymManagers.create');
    Route::GET('/gymManagers/{id}', [GymManagerController::class, 'show'])->name('gymManagers.show');
    Route::POST('/gymManagers', [GymManagerController::class, 'store'])->name('gymManagers.store');
    Route::GET('/gymManagers/{gymManager}/edit', [GymManagerController::class, 'edit'])->name('gymManagers.edit');
    Route::PUT('/gymManagers/{gymManager}', [GymManagerController::class, 'update'])->name('gymManagers.update');
    Route::DELETE('/gymManagers/{gymManager}', [GymManagerController::class, 'destroy'])->name('gymManagers.destroy');

    // ban and unban actions
    Route::GET('/gymManagers/{gymManager}/ban', [GymManagerController::class, 'ban'])->name('gymManagers.ban');
    Route::GET('/gymManagers/{gymManager}/unban', [GymManagerController::class, 'unban'])->name('gymManagers.unban');
});


// --------------- Cities
Route::group(['middleware' => 'auth', 'middleware' => 'role:admin'], function () {
    Route::GET('/cities', [CitiesController::class, 'index'])->name('cities.index');
    Route::GET('/cities/create', [CitiesController::class, 'create'])->name('cities.create');
    Route::GET('/cities/{id}', [CitiesController::class, 'show'])->name('cities.show');
    Route::POST('/cities/store', [CitiesController::class, 'store'])->name('cities.store');
    Route::GET('/cities/edit/{city_id}', [CitiesController::class, 'edit'])->name('cities.edit');
    Route::PUT('/cities/update/{city_id}', [CitiesController::class, 'update'])->name('cities.update');
    Route::DELETE('/cities/{id}', [CitiesController::class, 'destroy'])->name('cities.destroy');
});


// --------------- GYMS
Route::group(['middleware' => 'auth', 'middleware' => 'role:admin|cityManager'], function () {
    Route::GET('/gyms', [GymsController::class, 'index'])->name('gyms.index');
    Route::GET('/gyms/create', [GymsController::class, 'create'])->name('gyms.create');
    Route::GET('/gyms/{id}', [GymsController::class, 'show'])->name('gyms.show');
    Route::POST('/gyms/store', [GymsController::class, 'store'])->name('gyms.store');
    Route::GET('/gyms/edit/{gym_id}', [GymsController::class, 'edit'])->name('gyms.edit');
    Route::PUT('/gyms/update/{gym_id}', [GymsController::class, 'update'])->name('gyms.update');
    Route::DELETE('/gyms/{id}', [GymsController::class, 'destroy'])->name('gyms.destroy');
});

// --------------- Users
Route::group(['middleware' => 'auth', 'middleware' => 'role:admin|cityManager|gymManager'], function () {
    Route::GET('/users', [UserController::class, 'index'])->name('users.index');
    Route::GET('/users/create', [UserController::class, 'create'])->name('users.create');
    Route::GET('/users/{id}', [UserController::class, 'show'])->name('users.show');
    Route::GET('/json-gym', [UserController::class, 'GETGymNameFromCityName']);
    Route::GET('/users/{data}/edit', [UserController::class, 'edit'])->name('users.edit');
    Route::GET('/users/edit/{data}', [UserController::class, 'edit'])->name('users.edit');
    Route::POST('/users', [UserController::class, 'store'])->name('users.store');
    Route::PUT('/users/{user}', [UserController::class, 'update'])->name('users.update');
    Route::DELETE('/users/{id}', [UserController::class, 'destroy'])->name('users.destroy');
    Route::GET('/GET-users-my-datatables', [UserController::class, 'GETUsers'])->name('GET.users');
});


// --------------- Training Packages
Route::group(['middleware' => 'auth', 'middleware' => 'role:admin|cityManager|gymManager|client'], function () {
    Route::GET('/trainingPackages', [TrainingPackageController::class, 'index'])->name('trainingPackages.index');
    Route::GET('/trainingPackages/create', [TrainingPackageController::class, 'create'])->name('trainingPackages.create');
    Route::GET('/trainingPackages/{package}', [TrainingPackageController::class, 'show'])->name('trainingPackages.show');
    Route::GET('/trainingPackages/{package}/edit', [TrainingPackageController::class, 'edit'])->name('trainingPackages.edit');
    Route::PUT('/trainingPackages/{package}', [TrainingPackageController::class, 'update'])->name('trainingPackages.update');
    Route::POST('/trainingPackages', [TrainingPackageController::class, 'store'])->name('trainingPackages.store');
    Route::DELETE('/trainingPackages/{package}', [TrainingPackageController::class, 'destroy'])->name('trainingPackages.destroy');
});


// --------------- Sessions
Route::group(['middleware' => 'auth', 'middleware' => 'role:admin|cityManager|gymManager|client'], function () {
    Route::GET('/sessions', [TrainingSessionController::class, 'index'])->name('sessions.index');
    Route::GET('/sessions/create', [TrainingSessionController::class, 'create'])->name('sessions.create');
    Route::GET('/sessions/{id}', [TrainingSessionController::class, 'show'])->name('sessions.show');
    Route::POST('/sessions', [TrainingSessionController::class, 'store'])->name('sessions.store');
    Route::GET('/sessions/{id}/edit', [TrainingSessionController::class, 'edit'])->name('sessions.edit');
    Route::PUT('/sessions/{id}', [TrainingSessionController::class, 'update'])->name('sessions.update');
    Route::DELETE('/sessions/{id}', [TrainingSessionController::class, 'destroy'])->name('sessions.destroy');
    Route::GET('/json-coach', [TrainingSessionController::class, 'GetCoachNameFromGymName']);
});


// --------------- Coaches
Route::group(['middleware' => 'auth', 'middleware' => 'role:admin|cityManager|gymManager'], function () {
    Route::GET('/coaches', [CoachController::class, 'index'])->name('coaches.index');
    Route::GET('/coaches/create', [CoachController::class, 'create'])->name('coaches.create');
    Route::GET('/coaches/{id}', [CoachController::class, 'show'])->name('coaches.show');
    Route::POST('/coaches', [CoachController::class, 'store'])->name('coaches.store');
    Route::GET('/coaches/edit/{id}', [CoachController::class, 'edit'])->name('coaches.edit');
    Route::PUT('/coaches/{id}', [CoachController::class, 'update'])->name('coaches.update');
    Route::DELETE('/coaches/{id}', [CoachController::class, 'destroy'])->name('coaches.destroy');
});


// --------------- Attendance
Route::group(['middleware' => 'auth', 'middleware' => 'role:admin|cityManager|gymManager|client'], function () {
    Route::GET('/attendance', [AttendanceController::class, 'index'])->name('attendance.index')->middleware('auth');
});

// --------------- Buy Package
Route::group(['middleware' => 'auth', 'middleware' => 'role:admin|cityManager|gymManager|client'], function () {
    Route::GET('/GETGymsBelongsToCity/{id}', [BuyPackageController::class, 'GETGymsBelongsToCity']);

    Route::GET('/buyPackage', [BuyPackageController::class, 'index'])->name('buyPackage.index');
    Route::GET('/buyPackage/create', [BuyPackageController::class, 'create'])->name('buyPackage.create');
    Route::GET('/buyPackage/{package}', [BuyPackageController::class, 'show'])->name('buyPackage.show');
    Route::GET('/buyPackage/{package}/edit', [BuyPackageController::class, 'edit'])->name('buyPackage.edit');
    Route::PUT('/buyPackage/{package}', [BuyPackageController::class, 'update'])->name('buyPackage.update');
    Route::POST('/buy', [BuyPackageController::class, 'store'])->name('buyPackage.store');
    Route::DELETE('/buyPackage/{package}', [BuyPackageController::class, 'destroy'])->name('buyPackage.destroy');

    Route::POST('/create-checkout-session', [PaymentController::class, 'stripe'])->name('payment.stripe');
    Route::GET('/buyPackage/create/success', [PaymentController::class, 'success'])->name('buyPackage.success');
    Route::GET('/buyPackage/create/cancel', [PaymentController::class, 'cancel'])->name('buyPackage.cancel');
    Route::POST('/payment', [PaymentController::class, 'store'])->name('payment.store');

    Route::GET('/stripe-payment', [StripeController::class, 'handleGET']);
    Route::POST('/stripe-payment', [StripeController::class, 'handlePOST'])->name('stripe.payment');
});


// --------------- Revenue
Route::group(['middleware' => 'auth', 'middleware' => 'role:admin|cityManager|gymManager'], function () {
    Route::GET('/revenue', [RevenueController::class, 'index'])->name('revenue.index');
    Route::GET('/revenue/{id}', [RevenueController::class, 'show'])->name('revenue.show');
    Route::DELETE('/revenue/{id}', [RevenueController::class, 'destroy'])->name('revenue.destroy');
});


// --------------- Edit Profile
Route::group(['middleware' => 'auth', 'middleware' => 'role:admin|cityManager|gymManager|client'], function () {
    Route::GET('/profile/edit', [UserController::class, 'editProfile'])->name('profile.edit');
    Route::PUT('/profile/update', [UserController::class, 'updateProfile'])->name('profile.update');

    Route::GET('/profile/editPassword', [UserController::class, 'editPassword'])->name('profile.editPassword');
    Route::PUT('/profile', [UserController::class, 'updatePassword'])->name('profile.updatePassword');
});
