<?php

namespace App\Http\Controllers;

use App\User;
use App\Org;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();

        return view('user/index', compact('users'));
    }

    public function create()
    {
        return view('user/create', [
            'orgs' => Org::all()
        ]);
    }

    public function store()
    {
        request()->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'title' => 'required',
            'email' => 'required|unique:users',
            'maintains_orgs' => 'required|array',
            'maintains_orgs.*' => 'required|exists:orgs,title'
        ]);

        $user = User::create(request(['first_name','last_name','title','email']));

        foreach (request('maintains_orgs') as $org) {
            $user->orgs()->save(Org::where('title', $org)->first());
        }

        $user->save();

        return redirect('user/')->with('popup', 'user ' . request('first_name') . ' has been created!');
    }

    public function show($id)
    {
        //
    }

    public function edit(User $user)
    {
        return view('user/edit', [
            'user' => $user,
            'orgs' => Org::all(),
            'maintaining_org' => $user->org ? $user->org->title : ''
        ]);
    }

    public function update(User $user)
    {
        request()->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'title' => 'required',
            'email' => ['required', Rule::unique('users')->ignore($user->id)],
            'maintains_orgs' => 'required|array',
            'maintains_orgs.*' => 'required|exists:orgs,title'
        ]);

        $user->update(request(['first_name','last_name','email','title']));
        
        $user->orgs()->detach();
        foreach (request('maintains_orgs') as $org) {
            $orgModel = Org::where('title', $org)->first();
            $user->orgs()->attach($orgModel);
        }

        $user->save();
        
        return redirect('/user')->with('popup', 'user updated!');
    }

    public function destroy(User $user)
    {
        $user->delete();

        return redirect('/user')->with('popup', 'user has been deleted');
    }
}
