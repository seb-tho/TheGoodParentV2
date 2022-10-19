<?php

namespace App\Http\Controllers;

use App\Models\Child;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

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

    public function store()
    {
        Child::create(array_merge($this->validateChild(), [
            'user_id' => request()->user()->id
        ]));

        return redirect('/children');

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
        $child = Child::find($id);
        $child->delete();
        return back()->with('success', 'Child Deleted!');
    }

    protected function validateChild(?Child $child = null): array
    {
        $child ??= new Child();

        return request()->validate([
            'name' => 'required',
            'dateOfBirth' => 'required',
            'character_trait_id' => ['required', Rule::exists('character_traits', 'id')]
        ]);
    }
}
