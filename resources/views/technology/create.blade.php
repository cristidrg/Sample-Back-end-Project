@extends('layouts/default')

@section('title', 'Create Technology')

@section('content')
    <div>
        <div>
            @if(session()->get('popup'))
                {{ session()->get('popup') }}  
            @endif
        </div>
        <h1 class="mb-4 text-2xl font-bold">Create new technology</h1>
        <form class="text-base props-form__create" method="post" action={{ route('technology.store') }}>
            @csrf
            <div class="props-form__inputs">
                <div>
                    <label for="name">Technology Name</label>
                    <input required type="text" class="form-control" name="name" />
                </div>
                <button type="submit" class="block px-2 py-1 mt-4 bg-green-500 rounded-full lg:px-4 hover:bg-green-600 text lg:text-sm">Create</button>
            </div>
        </form>
    </div>
@stop
