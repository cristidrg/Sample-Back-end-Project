@extends('layout')

@section('title', 'Edit Prop')

@section('content')
    <div>
        <form method="post" action={{ route('prop.update', $prop->id) }}>
            @method('PATCH') 
            @csrf
            @php
                error_log($prop->title)
            @endphp
            <div>
                <label for="title">Prop Title:</label>
                <input required type="text" class="form-control" name="title" value="{{ $prop->title }}" />
            </div>
            <div>
                <label for="url">Prop Url:</label>
                <input required type="text" class="form-control" name="url" value="{{ $prop->url }}" />
            </div>
            <div>
                <label for="parent">Parent org:</label>
                <select name="parent" value="{{$parent_title}}">
                    @foreach ($orgs as $org)
                        @if ($org->title == $parent_title)
                            <option selected>{{$org->title}}</option>
                        @else
                            <option>{{$org->title}}</option>
                        @endif
                    @endforeach
                </select>
            </div>
            <div>
                <label for="technologies[]">Technologies:</label>
                <select name="technologies[]" multiple>
                    @foreach ($technologies as $technology)
                        @if (in_array($technology->name, array_column(json_decode($prop->technologies), 'name')))
                            <option selected>{{$technology->name}}</option>
                        @else
                            <option>{{$technology->name}}</option>
                        @endif
                    @endforeach
                </select>
            </div>
             <div>
                <label>Environments:</label>
                <div class="prop-environment-form">
                    @foreach ($propEnvs as $index=>$environment)
                        @php
                            $index = $index +1;
                        @endphp
                        <p>Environment {{$index}}</p>
                        <label>Type:</label>
                        <input type="text" name="{{'env_types['.$index.']'}}" value="{{$environment->type}}"/>

                        <label>Server:</label>
                        <input type="text" name="{{'env_servers['.$index.']'}}" value="{{$environment->server}}"/>

                        <label>URL:</label>
                        <input type="text" name="{{'env_urls['.$index.']'}}" value="{{$environment->url}}"/>
                    @endforeach
                </div>
                <button class="prop-environment-form__add">Add environment</button>
                <button class="prop-environment-form__remove">Remove environment</button>
            </div>
            <button type="submit">Update</button>
        </form>
    </div>
@stop
