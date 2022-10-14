<?php

use App\Models\Child;
use App\Models\Event;
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
//    $child = Child::with('characterTraits')->get()[0];
//    dd($child);
    return view('children', [
        'children' => Child::with('characterTraits')->get()
    ]);
});

Route::get('/child/{child}', function (Child $child) {

    return view('child', [
        'child' => Child::with('characterTraits')->where('id', '=', $child->id)->get()[0]
    ]);
});