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
        <h1 class="mb-4 text-2xl font-bold">Edit {{$prop->title}} Prop</h1>
        <form class="text-base props-form__create" method="post" action={{ route('prop.update', $prop->id) }}>
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
                    <select name="technologies[]" multiple class="h-40 text-black">
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
                <div class="mt-2 prop-environment-form">
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
                <button class="px-2 mr-2 text-xs bg-blue-500 rounded-full prop-environment-form__add hover:bg-blue-600">Add environment</button>
                <button class="px-2 text-xs bg-red-500 rounded-full prop-environment-form__remove hover:bg-red-600">Remove last environment</button>
                <button type="submit" class="block px-2 py-1 mt-4 bg-green-500 rounded-full lg:px-4 hover:bg-green-600 text lg:text-sm">Save Changes</button>
        </form>
    </div>
@stop
