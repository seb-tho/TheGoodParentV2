<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

class ChildController extends Controller
{
    //get all children for certain user id

    public function index()
    {
        $children = Auth::user()->children;
        return view('children', ['children' => $children]);
    }
}
