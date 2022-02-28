<?php

use App\Http\Controllers\GymManagerController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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

//Gym Managers Routes
Route::middleware(['auth'])->group(function () {
    Route::GET('/GymManagers', [GymManagerController::class, 'index'])->name('GymManagers.index');

    Route::GET('/GymManagers/create', [GymManagerController::class, 'create'])->name('GymManagers.create');
    Route::POST('/GymManagers', [GymManagerController::class, 'store'])->name('GymManagers.store');

    // Route::GET('/posts/{post}', [PostController::class, 'show'])->name('posts.show');

    Route::GET('/GymManagers/{GymManager}/edit', [GymManagerController::class, 'edit'])->name('GymManagers.edit');
    Route::PUT('/GymManagers/{GymManager}', [GymManagerController::class, 'update'])->name('GymManagers.update');

    Route::DELETE('/GymManagers/{GymManager}', [GymManagerController::class, 'destroy'])->name('GymManagers.destroy');
});
