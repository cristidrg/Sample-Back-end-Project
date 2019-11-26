@extends('layouts/default')

@section('title', 'Create Prop')

@section('content')
    <div>
        <div>
            @if(session()->get('popup'))
                {{ session()->get('popup') }}  
            @endif
        </div>
        <h1 class="text-2xl mb-4 font-bold">Create new property</h1>
        <form class="props-form__create text-base" method="post" action={{ route('prop.store') }}>
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
                    <select name="technologies[]" multiple class="text-black h-40">
                        @foreach ($technologies as $technology)
                            <option>{{$technology->name}}</option>
                        @endforeach
                    </select>
                </div>
                <label class="text-base font-bold">Environments</label>
                <div class="prop-environment-form mt-2">
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
                <button class="prop-environment-form__add px-2 mr-2 hover:bg-blue-600 bg-blue-500 text-xs rounded-full">Add Environment</button>
                <button class="prop-environment-form__remove px-2 hover:bg-red-600 bg-red-500 text-xs rounded-full">Delete Last Environment</button>
                <button type="submit" class="block px-2 lg:px-4 mt-4 py-1 bg-green-500 hover:bg-green-600 rounded-full text lg:text-sm">Create Prop</button>
            </div>
        </form>
    </div>
@stop
