<?php

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

//Gym Manager Routes
Route::middleware(['auth'])->group(function () {
    Route::GET('/test', [PostController::class, 'index'])->name('test.index');

    Route::GET('/test/create', [PostController::class, 'create'])->name('test.create');
    Route::POST('/test', [PostController::class, 'store'])->name('test.store');

    // Route::GET('/posts/{post}', [PostController::class, 'show'])->name('posts.show');

    Route::GET('/test/{test}/edit', [PostController::class, 'edit'])->name('test.edit');
    Route::PUT('/test/{test}', [PostController::class, 'update'])->name('test.update');

    Route::DELETE('/test/{test}', [PostController::class, 'destroy'])->name('test.destroy');
});
