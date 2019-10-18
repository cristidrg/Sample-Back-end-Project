<?php

namespace App\Http\Controllers;

use App\Org;
use App\Prop;
use App\Utils;
use Illuminate\Http\Request;
use Spatie\UptimeMonitor\Models\Monitor;

class PropController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $props = Prop::all();

        return view('prop/index', compact('props'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $orgs = Org::all();

        return view('prop/create', [
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
            'title' => 'required',
            'url' => 'required',
            'parent_org' => 'required'
        ]);

        if (Prop::where('url', $request->get('url'))->first() != null) {
            return redirect('/prop/create')->with('popup', 'Error: There is a prop with that url already.');
        }

        $parentOrg = Org::where('title', $request->get('parent_org'))->first();
        if ($parentOrg == null) {
            return redirect('/prop/create')->with('popup', 'Error: The given parent org does not exist.');
        }

        $monitor = Monitor::create(['url' => $request->get('url')]);
        $prop = Prop::create([
            'title' => $request->get('title'),
            'url' => $request->get('url')
        ]);

        $prop->monitor()->save($monitor);
        $parentOrg->props()->save($prop);

        return redirect('prop/')->with('popup', 'Prop ' . $request->get('title') . ' has been created!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $prop = Prop::find($id);

        $isPropUp = $prop->monitor->uptime_status == 'up' ? '1' : '0';

        return view('prop/show', [
            'prop' => $prop,
            'isPropUp' => $isPropUp,
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
        $prop = Prop::find($id);
        return view('prop/edit', [
            'prop' => $prop,
            'parent_title' => $prop->org->title,
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
            'url'=>'required',
            'parent' =>'required',
        ]);

        $prop = Prop::find($id);
        $prop->title =  $request->get('title');
        $prop->url = $request->get('url');
        
        $parentOrg = Org::where('title', $request->get('parent'))->first();
        
        $prop->org()->dissociate();
        $prop->save();


        $parentOrg->props()->save($prop);
        $prop->save();

        return redirect('/prop')->with('success', 'prop updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $prop = Prop::find($id);
        $prop->delete();

        return redirect('/prop')->with('popup', 'Prop with id ' . $id .' has been deleted');
    }
}
