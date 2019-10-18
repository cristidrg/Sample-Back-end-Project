@extends('layout')

@section('title', 'Edit Prop')

@section('content')
    <div>
        <form method="post" action={{ route('prop.update', $prop->id) }}>
            @method('PATCH') 
            @csrf
            <div>
                @csrf
                <label for="title">Prop Title:</label>
                <input required type="text" class="form-control" name="title" value={{ $prop->title }} />
            </div>
            <div>
                @csrf
                <label for="url">Prop Url:</label>
                <input required type="text" class="form-control" name="url" value={{ $prop->url }} />
            </div>
            <div>
                <label for="parent">Parent org:</label>
                <select name="parent" value={{$parent_title}}>
                    @foreach ($orgs as $org)
                        @if ($org->title == $parent_title)
                            <option selected>{{$org->title}}</option>
                        @else
                            <option>{{$org->title}}</option>
                        @endif
                    @endforeach
                </select>
            </div>
            <button type="submit">Update</button>
        </form>
    </div>
@stop
