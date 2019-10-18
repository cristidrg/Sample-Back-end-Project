@extends('layout')

@section('title', 'Create Org')

@section('content')
    <div>
        @if(session()->get('popup'))
            {{ session()->get('popup') }}  
        @endif
        <form method="post" action={{ route('org.store') }}>
            <div>
                @csrf
                <label for="org_title">Org Title:</label>
                <input required type="text" class="form-control" name="org_title" />
            </div>
            <div>
                <label for="org_parent">Org Parent:</label>
                <select name="org_parent">
                    @foreach ($orgs as $org)
                        <option>{{$org->title}}</option>
                    @endforeach
                </select>
            </div>
            <button type="submit">Add</button>
        </form>
    </div>
@stop
