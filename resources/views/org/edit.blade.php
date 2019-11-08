@extends('layout')

@section('title', 'Edit Org')

@section('content')
    <div>
        <form method="post" action={{ route('org.update', $org->id) }}>
            @method('PATCH') 
            @csrf
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
            <button type="submit" class="text-xl">Update</button>
        </form>
    </div>
@stop
