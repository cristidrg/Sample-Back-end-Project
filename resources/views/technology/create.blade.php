@extends('layout')

@section('title', 'Create Technology')

@section('content')
    <div>
        @if(session()->get('popup'))
            {{ session()->get('popup') }}  
        @endif
        <form method="post" action={{ route('technology.store') }}>
            <div>
                @csrf
                <label for="name">Technology Name:</label>
                <input required type="text" class="form-control" name="name" />
            </div>
            <button type="submit"  class="text-xl">Add</button>
        </form>
    </div>
@stop
