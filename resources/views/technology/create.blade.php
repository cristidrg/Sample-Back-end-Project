@extends('layouts/default')

@section('title', 'Create Technology')

@section('content')
    <div>
        <div>
            @if(session()->get('popup'))
                {{ session()->get('popup') }}  
            @endif
        </div>
        <h1 class="text-2xl mb-4 font-bold">Create new technology</h1>
        <form class="props-form__create text-base" method="post" action={{ route('technology.store') }}>
            @csrf
            <div class="props-form__inputs">
                <div>
                    <label for="name">Technology Name</label>
                    <input required type="text" class="form-control" name="name" />
                </div>
                <button type="submit" class="block px-2 lg:px-4 mt-4 py-1 bg-green-500 hover:bg-green-600 rounded-full text lg:text-sm">Create</button>
            </div>
        </form>
    </div>
@stop
