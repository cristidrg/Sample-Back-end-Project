<?php

namespace App\Http\Controllers;

use App\Org;
use App\Prop;
use App\Utils;
use App\Technology;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Spatie\UptimeMonitor\Models\Monitor;

class PropController extends Controller
{
    public function index()
    {
        $props = Prop::all();

        return view('prop/index', compact('props'));
    }

    public function create()
    {
        return view('prop/create', [
            'orgs' => Org::all(),
            'technologies' => Technology::all()
        ]);
    }

    public function store()
    {
        request()->validate([
            'title' => 'required',
            'url' => 'required|unique:props',
            'parent_org' => 'required|exists:orgs,title',
            'technologies' => 'required|array',
            'technologies.*' => 'required|exists:technologies,name',
            'env_types' => 'required|array',
            'env_servers' => 'required|array',
            'env_urls' => 'required|array',
        ]);

        $environments = array();
        foreach (request('env_types') as $index => $env_type) {
            $environments[$index] = [
                'type' => $env_type,
                'server' => request('env_servers')[$index],
                'url' => request('env_servers')[$index]
            ];
        }

        $prop = Prop::create([
            'title' => request('title'),
            'url' => request('url'),
            'environments' => $environments
        ]);

        $prop->monitor()->save(Monitor::create(['url' => request('url')]));
        Org::where('title', request('parent_org'))->first()->props()->save($prop);
        
        foreach (request('technologies') as $technology) {
            $prop->technologies()->save(Technology::where('name', $technology)->first());
        }

        return redirect('prop/')->with('popup', 'Prop ' . request('title') . ' has been created!');
    }

    public function show(Prop $prop)
    {
        return view('prop/show', [
            'prop' => $prop,
            'isPropUp' => $prop->monitor->uptime_status == 'up' ? '1' : '0',
            'utils' => new Utils,
            'contacts' => $prop->getContacts($prop)
        ]);
    }

    public function edit(Prop $prop)
    {
        return view('prop/edit', [
            'prop' => $prop,
            'parent_title' => $prop->org->title,
            'orgs' => Org::all(),
            'technologies' => Technology::all()
        ]);
    }

    public function update(Prop $prop)
    {
        request()->validate([
            'title' => 'required',
            'url' => ['required', Rule::unique('props')->ignore($prop->id)],
            'parent_org' => 'required|exists:orgs,title',
            'technologies' => 'required|array',
            'technologies.*' => 'required|exists:technologies,name',
            'env_types' => 'required|array',
            'env_servers' => 'required|array',
            'env_urls' => 'required|array',
        ]);


        $environments = array();
        foreach (request('env_types') as $index => $env_type) {
            $environments[$index] = [
                'type' => $env_type,
                'server' => request('env_servers')[$index],
                'url' => request('env_servers')[$index]
            ];
        }

        $prop->update(array_merge(request(['title','url'])),[
            'environments' => $environments
        ]);

        $prop->technologies()->detach();
        foreach (request('technologies') as $technology) {
            $prop->technologies()->attach(Technology::where('name', $technology)->first());
        }

        //TODO: Idk why I can't do prop->org->detach or dissociate. It needs to be done to prevent errors in editing.
        Org::where('title', request('parent_org'))->first()->props()->save($prop);

        return redirect('/prop')->with('success', 'prop updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Prop $prop)
    {
        $prop->delete();

        return redirect('/prop')->with('popup', 'Prop has been deleted');
    }
}
