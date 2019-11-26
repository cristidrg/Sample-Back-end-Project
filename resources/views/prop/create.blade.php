@extends('layouts/default')

@section('title', 'Create Prop')

@section('content')
    <div>
        @if ($errors->any())
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        @endif
        <form method="post" action={{ route('prop.store') }}>
            @csrf
            <div>
                <label for="title">Title:</label>
                <input required type="text" class="form-control" name="title" />
            </div>
            <div>
                <label for="url">Url:</label>
                <input required type="text" class="form-control" name="url" /> 
            </div>
            <div>
                <label for="parent_org">Parent Org:</label>
                <select name="parent_org" class="text-black">
                    @foreach ($orgs as $org)
                        <option>{{$org->title}}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label for="securityScore">Security Score:</label>
                <input required type="text" class="form-control" name="securityScore" value="" />
            </div>
            <div>
                <label for="technologies">Technologies:</label>
                <select name="technologies[]" multiple class="text-black">
                    @foreach ($technologies as $technology)
                        <option>{{$technology->name}}</option>
                    @endforeach
                </select>
            </div>
            <br>
            <div>
                <label>Environments:</label>
                <div class="prop-environment-form">
					<div id="prop-environmnet-form__entry-1">
                        <p>Environment 1</p>
                        <label>Type:</label>
						<input type="text" name="env_types[1]"/>

                        <label>Server:</label>
						<input type="text" name="env_servers[1]"/>

                        <label>URL:</label>
						<input type="text" name="env_urls[1]"/>
					</div>
				</div>
                <button class="prop-environment-form__add">Add environment</button>
                <button class="prop-environment-form__remove">Remove environment</button>
            </div>
            <button type="submit"  class="text-xl">Create new prop</button>
        </form>
    </div>
@stop
