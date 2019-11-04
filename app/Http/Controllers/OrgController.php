<?php

namespace App\Http\Controllers;

use App\Org;
use App\Utils;
use Illuminate\Http\Request;

class OrgController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orgs = Org::all();

        return view('org/index', compact('orgs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $orgs = Org::all();

        return view('org/create', [
            'orgs' => $orgs
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
            'org_title'=>'required',
            'org_parent'=>'required',
        ]);

        if (Org::where('title', $request->get('org_title'))->first() != null) {
            return redirect('/org/create')->with('popup', 'Error: There is an org with that title already.');
        }

        $orgParent = Org::where('title', $request->get('org_parent'))->first();
        if ($orgParent == null) {
            return redirect('/org/create')->with('popup', 'Error: The parent org does not exist');
        }

        $org = Org::create(['title' => $request->get('org_title')], $orgParent);

        return redirect('/org/create')->with('popup', 'Org ' . $request->get('org_title') . ' has been created!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public static function show($id)
    {
        $org = Org::find($id);

        return view('org/show', [
            'org' => $org,
            'childrenOrgs' => $org->children,
            'childrenProps' => $org->props,
            'a11yScore' => $org->getA11yScore(),
            'perfScore' => $org->getPerfScore(),
            'seoScore' => $org->getSeoScore(),
            'uptimeScore' => $org->getUptimeScore(),
            'utils' => new Utils
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $org = Org::find($id);
        return view('org/edit', [
            'org' => $org,
            'parent_title' => $org->parent ? $org->parent->title : '',
            'orgs' => Org::all()
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
            'title'=>'required',
            'description'=>'required',
            'parent' =>'required',
        ]);

        $org = Org::find($id);
        $org->title =  $request->get('title');
        $org->description = $request->get('description');
        
        $orgParent = Org::where('title', $request->get('parent'))->first();
        $org->parent_id = $orgParent->id;

        $org->save();

        return redirect('/org')->with('success', 'org updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $org = Org::find($id);
        $org->delete();

        return redirect('/org')->with('popup', 'Org with id ' . $id .' has been deleted');
    }
}
