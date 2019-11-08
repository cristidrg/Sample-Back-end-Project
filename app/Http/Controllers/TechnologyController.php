<?php

namespace App\Http\Controllers;

use App\Technology;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class TechnologyController extends Controller
{
    public function index()
    {
        return view('technology/index', [
            'technologies' => Technology::all()
        ]);
    }

    public function create()
    {
        return view('technology/create');
    }

    public function store()
    {
        request()->validate([
            'name' => 'required|unique:technologies'
        ]);

        Technology::create(['name' => request('name')]);

        return redirect('technology/')->with('popup', 'Technology ' . request('title') . ' has been created!');
    }

    public function show($id) {}

    public function edit(Technology $technology)
    {
        return view('technology/edit', ['technology' => $technology]);
    }

    public function update(Technology $technology)
    {
        request()->validate([
            'name' => ['required', Rule::unique('technologies')->ignore($technology->id)]
        ]);

        $technology->name = request('name');
        $technology->save();

        return redirect('/technology')->with('popup', 'technology updated!');
    }

    public function destroy(Technology $technology)
    {
        $technology->delete();

        return redirect('/technology')->with('popup', 'technology has been deleted');
    }
}
