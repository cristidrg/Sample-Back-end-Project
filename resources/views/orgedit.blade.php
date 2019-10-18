@extends('layout')

@section('title', 'Org')

@section('content')
    <div>
        <form method="post" action={{ route('org.update', $org->id) }}>
            @method('PATCH') 
            @csrf
            <div>
                @csrf
                <label for="title">Org Title:</label>
                <input required type="text" class="form-control" name="title" value={{ $org->title }} />
            </div>
            <div>
                @csrf
                <label for="description">Org Description:</label>
                <input required type="text" class="form-control" name="description" value={{ $org->description }} />
            </div>
            <div>
                <label for="parent">Org Parent:</label>
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
