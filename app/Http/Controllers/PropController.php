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
            'securityScore'=> 'required|numeric|between:0,1'
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
            'securityScore' => request('securityScore')
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
            'env_types.*' => 'required|string',
            'env_servers' => 'required|array',
            'env_servers.*' => 'required|string',
            'env_urls' => 'required|array',
            'env_urls.*' => 'required|string',
            'securityScore'=> 'required|numeric|between:0,1'
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

        //TODO: Idk why I can't do prop->org->detach or dissociate. It needs to be done to prevent errors in editing.
        Org::where('title', request('parent_org'))->first()->props()->save($prop);

        return redirect('/prop')->with('success', 'prop updated!');
    }

    public function destroy(Prop $prop)
    {
        $prop->delete();

        return redirect('/prop')->with('popup', 'Prop has been deleted');
    }

    private function filter()
    {
        $propResults = Prop::all();
        $seo = Input::get('seo');
        $a11y = Input::get('a11y');
        $perf = Input::get('perf');
        $uptime = Input::get('uptime');
        $org = Input::get('org');
        $security = Input::get('security');
    
        if ($seo != null) {
            $values = explode('-', trim($seo));
    
            $propResults = $propResults->filter(function ($prop) use (&$values){
                return ($prop->seoScore * 100 >= $values['0'] && $prop->seoScore * 100 <= $values['1']);
            });
        }
    
        if ($a11y != null) {
            $values = explode('-', trim($a11y));
    
            $propResults = $propResults->filter(function ($prop) use (&$values){
                return ($prop->a11yScore * 100 >= $values['0'] && $prop->a11yScore * 100 <= $values['1']);
            });
        }
    
        if ($perf != null) {
            $values = explode('-', trim($perf));
    
            $propResults = $propResults->filter(function ($prop) use (&$values){
                return ($prop->perfScore * 100 >= $values['0'] && $prop->perfScore * 100 <= $values['1']);
            });
        }
    
        if ($security != null) {
            $values = explode('-', trim($security));
    
            $propResults = $propResults->filter(function ($prop) use (&$values){
                return ($prop->securityScore * 100 >= $values['0'] && $prop->securityScore * 100 <= $values['1']);
            });
        }
    
        if ($uptime != null) {
            $propResults = $propResults->filter(function ($prop) use (&$uptime){
                return $prop->monitor->uptime_status == $uptime;
            });
        }
    
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
        return PropResource::collection($this->filter()); //pagination done with appending ->forPage(0, 15)        
    }
}
