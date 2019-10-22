<?php

namespace App\Http\Controllers;

use App\Org;
use App\Prop;
use App\Utils;
use App\Technology;
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
        return view('prop/create', [
            'orgs' => Org::all(),
            'technologies' => Technology::all()
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

        $environments = array();
        $env_types = $request->get('env_types');
        $env_servers = $request->get('env_servers');
        $env_urls = $request->get('env_urls');

        if ($env_types && count($env_types) > 0) {
            foreach ($env_types as $index => $env_type) {
                $env_entry = [];
                $env_entry['type'] = $env_type;
                $env_entry['server'] = $env_servers[$index];
                $env_entry['url'] = $env_urls[$index];

                $environments[$index] = $env_entry;
            }
        }

        $prop = Prop::create([
            'title' => $request->get('title'),
            'url' => $request->get('url'),
            'environments' => json_encode(array_values($environments))
        ]);

        $monitor = Monitor::create(['url' => $request->get('url')]);
        $prop->monitor()->save($monitor);

        $parentOrg = Org::where('title', $request->get('parent_org'))->first();
        $parentOrg->props()->save($prop);

        $technologies = $request->get('technologies');
        if ($technologies && count($technologies) > 0) {
            foreach ($technologies as $technology) {
                $technologyModel = Technology::where('name', $technology)->first();
                $prop->technologies()->save($technologyModel);
            }
        }

        $prop->save();

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
        $propEnvs = json_decode($prop->environments);
        // error_log($propEnvs);
        return view('prop/edit', [
            'prop' => $prop,
            'propEnvs' => $propEnvs ? $propEnvs : [],
            'parent_title' => $prop->org->title,
            'orgs' => Org::all(),
            'technologies' => Technology::all()
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
            'title' => 'required',
            'url' => 'required',
            'parent' => 'required'
        ]);

        $prop = Prop::find($id);
        $prop->title =  $request->get('title');
        $prop->url = $request->get('url');

        $environments = array();
        $env_types = $request->get('env_types');
        $env_servers = $request->get('env_servers');
        $env_urls = $request->get('env_urls');

        if ($env_types && count($env_types) > 0) {
            foreach ($env_types as $index => $env_type) {
                $env_entry = [];
                $env_entry['type'] = $env_type;
                $env_entry['server'] = $env_servers[$index];
                $env_entry['url'] = $env_urls[$index];

                $environments[$index] = $env_entry;
            }
        }
        $prop->environments = json_encode($environments);

        $technologies = $request->get('technologies');
        if ($technologies && count($technologies) > 0) {
            $prop->technologies()->detach();

            foreach ($technologies as $technology) {
                $technologyModel = Technology::where('name', $technology)->first();
                $prop->technologies()->attach($technologyModel);
            }
        }

        $parentOrg = Org::where('title', $request->get('parent'))->first();
        $prop->org()->dissociate();
        $parentOrg->props()->dissociate($prop);
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

        return redirect('/prop')->with('popup', 'Prop with id ' . $id . ' has been deleted');
    }
}
