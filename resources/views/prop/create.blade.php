@extends('layouts/default')

@section('title', 'Create Prop')

@section('content')
    <div>
        <div>
            @if(session()->get('popup'))
                {{ session()->get('popup') }}  
            @endif
        </div>
        <h1 class="mb-4 text-2xl font-bold">Create new property</h1>
        <form class="text-base props-form__create" method="post" action={{ route('prop.store') }}>
            @csrf
            <div class="props-form__inputs">
                <div>
                    <label for="title">Title</label>
                    <input required type="text" class="form-control" name="title" />
                </div>
                <div>
                    <label for="url">Url</label>
                    <input required type="text" class="form-control" name="url" /> 
                </div>
                <div>
                    <label for="parent_org">Parent Org</label>
                    <select name="parent_org" class="text-black">
                        @foreach ($orgs as $org)
                            <option>{{$org->title}}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label for="securityScore">Security Score</label>
                    <input required type="text" class="form-control" name="securityScore" value="" />
                </div>
                <div>
                    <label for="technologies">Technologies</label>
                    <select name="technologies[]" multiple class="h-40 text-black">
                        @foreach ($technologies as $technology)
                            <option>{{$technology->name}}</option>
                        @endforeach
                    </select>
                </div>
                <label class="text-base font-bold">Environments</label>
                <div class="mt-2 prop-environment-form">
                    <div id="prop-environmnet-form__entry-1">
                        <p>Environment 1</p>
                        <label>Type</label>
                        <input type="text" name="env_types[1]"/>

                        <label>Server</label>
                        <input type="text" name="env_servers[1]"/>

                        <label>URL</label>
                        <input type="text" name="env_urls[1]"/>
                    </div>
                </div>
                <button class="px-2 mr-2 text-xs bg-blue-500 rounded-full prop-environment-form__add hover:bg-blue-600">Add Environment</button>
                <button class="px-2 text-xs bg-red-500 rounded-full prop-environment-form__remove hover:bg-red-600">Delete Last Environment</button>
                <button type="submit" class="block px-2 py-1 mt-4 bg-green-500 rounded-full lg:px-4 hover:bg-green-600 text lg:text-sm">Create Prop</button>
            </div>
        </form>
    </div>
@stop
