<?php

namespace App\Http\Controllers;

use App\Models\Child;
use Illuminate\Support\Facades\Auth;

class ChildController extends Controller
{
    //get all child for certain user id

    public function index()
    {
        $children = Auth::user()->children;
        return view('child.children', ['children' => $children]);
    }

    public function store(Child $child){
        dd($child);
    }
}
