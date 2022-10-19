<?php

namespace App\Http\Controllers;

use App\Models\Child;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChildController extends Controller
{
    //get all child for certain user id
    public function index()
    {
        $children = Auth::user()->children;
        return view('child.index', ['children' => $children]);
    }

    public function create()
    {
       return view('child.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }


    public function show($id)
    {
        $child = Child::with('characterTraits')->find($id);
        return view('child.show', ['child' => $child]);
    }

    public function edit($id)
    {

    }

    public function update(Request $request, $id)
    {

    }

    public function destroy($id)
    {

    }
}
