@extends('layouts/default')

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
        <h1 class="text-2xl mb-4 font-bold">Edit {{$prop->title}} Prop</h1>
        <form class="props-form__create text-base" method="post" action={{ route('prop.update', $prop->id) }}>
            @method('PATCH') 
            @csrf
            <div class="props-form__inputs">
                <div>
                    <label for="title">Title</label>
                    <input required type="text" class="form-control" name="title" value="{{ $prop->title }}" />
                </div>
                <div>
                    <label for="url">Prop Url</label>
                    <input required type="text" class="form-control" name="url" value="{{ $prop->url }}" />
                </div>
                <div>
                    <label for="parent_org">Parent org</label>
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
                    <label for="securityScore">Security Score</label>
                    <input required type="text" class="form-control" name="securityScore" value="{{ $prop->securityScore }}" />
                </div>
                <div>
                    <label for="technologies[]">Technologies</label>
                    <select name="technologies[]" multiple class="text-black h-40">
                        @foreach ($technologies as $technology)
                            @if (in_array($technology->name, array_column(json_decode($prop->technologies), 'name')))
                                <option selected>{{$technology->name}}</option>
                            @else
                                <option>{{$technology->name}}</option>
                            @endif
                        @endforeach
                    </select>
                </div>
                <label class="text-base font-bold">Environments</label>
                <div class="prop-environment-form mt-2">
                    @foreach ($prop->environments as $index=>$environment)
                        @php $index = $index +1; @endphp
                        <div id={{'prop-environmnet-form__entry-'.$index}}>
                            <p>Environment {{$index}}</p>
                            <label>Type:</label>
                            <input type="text" name="{{'env_types['.$index.']'}}" value="{{$environment['type']}}"/>

                            <label>Server:</label>
                            <input type="text" name="{{'env_servers['.$index.']'}}" value="{{$environment['server']}}"/>

                            <label>URL:</label>
                            <input type="text" name="{{'env_urls['.$index.']'}}" value="{{$environment['url']}}"/>
                        </div>

                    @endforeach
                </div>
                <button class="prop-environment-form__add px-2 mr-2 hover:bg-blue-600 bg-blue-500 text-xs rounded-full">Add environment</button>
                <button class="prop-environment-form__remove px-2 hover:bg-red-600 bg-red-500 text-xs rounded-full">Remove environment</button>
                <button type="submit" class="block px-2 lg:px-4 mt-4 py-1 bg-green-500 hover:bg-green-600 rounded-full text lg:text-sm">Save Changes</button>
        </form>
    </div>
@stop
