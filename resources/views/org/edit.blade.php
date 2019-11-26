@extends('layouts/default')

@section('title', 'Edit Org')

@section('content')
    <div>
        @if ($errors->any())
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        @endif
        <h1 class="text-2xl mb-4 font-bold">Edit {{$org->title}} Org</h1>
        <form class="props-form__create text-base" method="post" action={{ route('org.update', $org->id) }}>
            @method('PATCH') 
            @csrf
            <div class="props-form__inputs">
                <div>
                    @csrf
                    <label for="title">Org Title:</label>
                    <input required type="text" class="form-control" name="title" value="{{ $org->title }}" />
                </div>
                <div>
                    <label for="parent">Org Parent:</label>
                    <select name="parent" value="{{$parent_title}}" class="text-black">
                        @foreach ($orgs as $org)
                            @if ($org->title == $parent_title)
                                <option selected>{{$org->title}}</option>
                            @else
                                <option>{{$org->title}}</option>
                            @endif
                        @endforeach
                    </select>
                </div>
            <button type="submit" class="block px-2 lg:px-4 mt-4 py-1 bg-green-500 hover:bg-green-600 rounded-full text lg:text-sm">Update</button>
            </div>
        </form>
    </div>
@stop
