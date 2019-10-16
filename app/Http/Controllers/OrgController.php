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
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $orgs = Org::all();

        return view('orgcreate', [
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
        
        $orgParent = Org::where('title', $request->get('org_parent'))->first();;
        info($orgParent);

        if ($orgParent == null) {
            return redirect('/org/create', [
                'popup' => 'Fail to create'
            ]);
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
    public function show($id)
    {
        $org = Org::find($id);

        return view('org', [
            'org' => $org,
            'childrenOrgs' => $org->children,
            'childrenProps' => $org->props,
            'a11yScore' => $org->getA11yScore(),
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
