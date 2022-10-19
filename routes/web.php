<?php

use App\Http\Controllers\AdminAdviceController;
use App\Http\Controllers\AdminLifeEventController;
use App\Http\Controllers\AdminUserController;
use App\Http\Controllers\ChildController;
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
    return Redirect::route('children.index');
});

//Auth
Route::get('/login', function () {
    return view('auth.login');
});

//Advice
Route::resource('advice', 'App\Http\Controllers\AdviceController')->middleware(['auth', 'verified'])->except('create', 'edit', 'update', 'destroy');

//Children
Route::resource('children', ChildController::class)->middleware(['auth', 'verified']);

//Life events
Route::resource('life-events', 'App\Http\Controllers\LifeEventController')->middleware(['auth', 'verified'])->except('create', 'edit', 'update', 'destroy');

//Reviews
Route::resource('reviews', 'App\Http\Controllers\ReviewController')->middleware(['auth', 'verified'])->except('index', 'edit', 'update', 'destroy');


// Admin
Route::middleware('can:admin')->group(function () {
    Route::resource('admin/life-events', AdminLifeEventController::class)->except('index', 'show');
    Route::resource('admin/advice', AdminAdviceController::class)->except('index', 'show');
    Route::resource('admin/user', AdminUserController::class);
});


require __DIR__ . '/auth.php';
