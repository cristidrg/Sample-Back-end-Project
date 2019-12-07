<?php

namespace App\Http\Controllers;

use App\Org;
use App\Prop;
use App\Utils;
use App\Technology;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Input;
use App\Http\Resources\PropResource;

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
            'env_types.*' => 'required|string',
            'env_servers' => 'required|array',
            'env_servers.*' => 'required|string',
            'env_urls' => 'required|array',
            'env_urls.*' => 'required|string',
            'securityScore'=> 'required|numeric|between:0,100',
            'brandScore'=> 'required|numeric|between:0,100',
            'perfScore'=> 'required|numeric|between:0,100',
            'notes' => 'string'
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
            'environments' => $environments,
            'securityScore' => request('securityScore'),
            'brandScore' => request('brandScore'),
            'perfScore' => request('perfScore')
        ]);

        $prop->monitor()->save(Monitor::create(['url' => request('url')]));
        Org::where('title', request('parent_org'))->first()->props()->save($prop);
        
        foreach (request('technologies') as $technology) {
            $prop->technologies()->save(Technology::where('name', $technology)->first());
        }

        if (request('notes')) {
            $prop->notes = request('notes');
            $prop->save();
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
            'env_types.*' => 'required|string',
            'env_servers' => 'required|array',
            'env_servers.*' => 'required|string',
            'env_urls' => 'required|array',
            'env_urls.*' => 'required|string',
            'securityScore'=> 'required|numeric|between:0,100',
            'brandScore'=> 'required|numeric|between:0,100',
            'perfScore'=> 'required|numeric|between:0,100',
            'notes' => 'string'
        ]);


        $environments = array();
        foreach (request('env_types') as $index => $env_type) {
            $environments[$index] = [
                'type' => $env_type,
                'server' => request('env_servers')[$index],
                'url' => request('env_servers')[$index]
            ];
        }

        $prop->update(array_merge(request(['title','url', 'securityScore'])),[
            'environments' => $environments
        ]);

        $prop->technologies()->detach();
        foreach (request('technologies') as $technology) {
            $prop->technologies()->attach(Technology::where('name', $technology)->first());
        }

        if (request('notes')) {
            $prop->notes = request('notes');
            $prop->save();
        }

        //TODO: Idk why I can't do prop->org->detach() or dissociate().
        //While we don't have a use case were props change orgs,
        //doing this currently might result in some faulty saves as
        // we can't unbind the orgs from the props
        Org::where('title', request('parent_org'))->first()->props()->save($prop);

        return redirect('/prop')->with('success', 'prop updated!');
    }

    public function destroy(Prop $prop)
    {
        $prop->delete();

        return redirect('/prop')->with('popup', 'Prop has been deleted');
    }

    //TODO: Check for invalid values/formatting issues on query params
    private function filter()
    {
        $propResults = Prop::all();

        // #Maintenance: To add a new score to filter by in the api, put it in this array 
        $filterableScores = ['seo', 'a11y', 'perf', 'security', 'brand', 'qa'];

        foreach ($filterableScores as $scoreType) {
            if (Input::get($scoreType) != null) {
                $values = explode('-', trim(Input::get($scoreType)));

                $propResults = $propResults->filter(function ($prop) use (&$values, &$scoreType){
                    return ($prop->getAttribute($scoreType . 'Score')  >= $values['0'] && $prop->getAttribute($scoreType . 'Score')  <= $values['1']);
                });
            }   
        }

        $uptime = Input::get('uptime');
        if ($uptime != null) {
            $propResults = $propResults->filter(function ($prop) use (&$uptime){
                return $prop->monitor->uptime_status == $uptime;
            });
        }
    
        $org = Input::get('org');
        if ($org != null) {
            $propResults = $propResults->filter(function ($prop) use (&$org){
                return $prop->org_id == $org;
            });
        }
        
        return $propResults;
    }
    
    public function filterByParams()
    {
        return view('search', [
            'propResults' => $this->filter(),
        ]);
    }

    public function apiFilterByParams()
    {
        // #Maintenance: To add pagination append ->forPage(0, 15) below    
        return PropResource::collection($this->filter());    
    }
}
