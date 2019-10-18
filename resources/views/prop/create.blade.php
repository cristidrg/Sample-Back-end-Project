@extends('layout')

@section('title', 'Create Prop')

@section('content')
    <div>
        @if(session()->get('popup'))
            {{ session()->get('popup') }}  
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
                <select name="parent_org">
                    @foreach ($orgs as $org)
                        <option>{{$org->title}}</option>
                    @endforeach
                </select>
            </div>
            <button type="submit">Add</button>
        </form>
    </div>
@stop
