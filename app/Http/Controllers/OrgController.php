<?php

namespace App\Http\Controllers;

use App\Org;
use App\Utils;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class OrgController extends Controller
{
    public function index()
    {
        return view('org/index', [
            'orgs' => Org::all()
        ]);
    }

    public function create()
    {
        return view('org/create', [
            'orgs' => Org::all()
        ]);
    }

    public function store()
    {
        request()->validate([
            'org_title'=>'required|unique:orgs,title',
            'org_parent'=>'required|exists:orgs,title',
        ]);

        Org::create(
            ['title' => request('org_title')], 
            Org::where('title', request('org_parent'))->first()
        );

        return redirect('/org')->with('popup', 'Org ' . request('org_title') . ' has been created!');
    }

    public static function show(Org $org)
    {
        return view('org/show', [
            'org' => $org
        ]);
    }

    public function edit(Org $org)
    {
        return view('org/edit', [
            'org' => $org,
            'parent_title' => $org->parent ? $org->parent->title : '',
            'orgs' => Org::all()
        ]);
    }

    public function update(Org $org)
    {
        request()->validate([
            'title'=> ['required', Rule::unique('orgs')->ignore($org->id)],
            'parent' => 'required|exists:orgs,title',
        ]);

        $org->update(request(['title']));
        $org->parent_id = Org::where('title', request('parent'))->first()->id;
        $org->save();
        
        return redirect('/org')->with('success', 'org updated!');
    }

    public function destroy(Org $org)
    {
        $org->delete();

        return redirect('/org')->with('popup', 'Org has been deleted');
    }
}
