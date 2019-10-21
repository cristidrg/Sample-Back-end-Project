<?php

namespace App\Http\Controllers;

use App\User;
use App\Org;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();

        return view('user/index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('user/create', [
            'orgs' => Org::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'title' => 'required',
            'email' => 'required',
            'maintains_org' => 'required'
        ]);

        if (User::where('email', $request->get('email'))->first() != null) {
            return redirect('/user/create')->with('popup', 'Error: There is a user with this email');
        }

        $user = User::create([
            'first_name' => $request->get('first_name'),
            'last_name' => $request->get('last_name'),
            'title' => $request->get('title'),
            'email' => $request->get('email')
        ]);

        $orgToMaintain = Org::where('title', $request->get('maintains_org'))->first();
        $orgToMaintain->contact()->save($user);

        $user->save();

        return redirect('user/')->with('popup', 'user ' . $request->get('first_name') . ' has been created!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find($id);

        return view('user/edit', [
            'user' => $user,
            'orgs' => Org::all(),
            'maintaining_org' => $user->org ? $user->org->title : ''
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'title' => 'required',
            'email' => 'required',
            'maintaining_org' => 'required'
        ]);

        $user = User::find($id);
        $user->first_name = $request->get('first_name');
        $user->last_name = $request->get('last_name');
        $user->email = $request->get('email');
        $user->title = $request->get('title');

        $orgToMaintain = Org::where('title', $request->get('maintaining_org'))->first();
        $user->org()->dissociate();
        $orgToMaintain->contact()->save($user);
        
        $user->save();
        
        return redirect('/user')->with('popup', 'user updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::find($id);
        $user->delete();

        return redirect('/user')->with('popup', 'user has been deleted');
    }
}
