<?php

use App\Http\Controllers\ChildController;
use App\Models\Child;
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

Route::get('/login', function () {
    return view('auth.login');
});

//Route::get('/dashboard', function () {
//    return view('dashboard');
//})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/', [ChildController::class, 'index'])->middleware(['auth', 'verified'])->name('home');

Route::get('child/add-child', function () {
    return view('child.add-child');
});

Route::get('/child/{child}', function (Child $child) {
    return view('child/child-detail', [
        'child' => Child::with('characterTraits')->where('id', '=', $child->id)->get()[0]
    ]);
});

Route::post('child/{child}', [ChildController::class, 'store']);

require __DIR__ . '/auth.php';
