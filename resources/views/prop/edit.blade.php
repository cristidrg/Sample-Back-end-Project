@extends('layout')

@section('title', 'Edit Prop')

@section('content')
    <div>
        @if ($errors->any())
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        @endif
        <form method="post" action={{ route('prop.update', $prop->id) }}>
            @method('PATCH') 
            @csrf

            <div>
                <label for="title">Prop Title:</label>
                <input required type="text" class="form-control" name="title" value="{{ $prop->title }}" />
            </div>
            <div>
                <label for="url">Prop Url:</label>
                <input required type="text" class="form-control" name="url" value="{{ $prop->url }}" />
            </div>
            <div>
                <label for="parent_org">Parent org:</label>
                <select name="parent_org" value="{{$parent_title}}" class="text-black">
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
                <select name="technologies[]" multiple class="text-black">
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
                    @foreach ($prop->environments as $index=>$environment)
                        @php $index = $index +1; @endphp

                        <p>Environment {{$index}}</p>
                        <label>Type:</label>
                        <input type="text" name="{{'env_types['.$index.']'}}" value="{{$environment['type']}}"/>

                        <label>Server:</label>
                        <input type="text" name="{{'env_servers['.$index.']'}}" value="{{$environment['server']}}"/>

                        <label>URL:</label>
                        <input type="text" name="{{'env_urls['.$index.']'}}" value="{{$environment['url']}}"/>
                    @endforeach
                </div>
                <button class="prop-environment-form__add">Add environment</button>
                <button class="prop-environment-form__remove">Remove environment</button>
            </div>
            <button type="submit" class="text-xl">Update</button>
        </form>
    </div>
@stop
