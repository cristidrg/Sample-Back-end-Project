@extends('layouts/default')

@section('title', 'Edit Technology')

@section('content')
    <div>
        @if ($errors->any())
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        @endif
        <h1 class="text-2xl mb-4 font-bold">Edit Technology</h1>
        <form class="props-form__create text-base" method="post" action={{ route('technology.update', $technology->id) }}>
            @method('PATCH') 
            @csrf
            <div class="props-form__inputs">

                <div>
                    <label for="name">Technology Name</label>
                    <input required type="text" class="form-control" name="name" value="{{ $technology->name }}" />
                </div>
                <button type="submit" class="block px-2 lg:px-4 mt-4 py-1 bg-green-500 hover:bg-green-600 rounded-full text lg:text-sm">Save changes</button>
            </div>
        </form>
    </div>
@stop
