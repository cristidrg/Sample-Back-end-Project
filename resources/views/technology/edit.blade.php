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
        <h1 class="mb-4 text-2xl font-bold">Edit Technology</h1>
        <form class="text-base props-form__create" method="post" action={{ route('technology.update', $technology->id) }}>
            @method('PATCH') 
            @csrf
            <div class="props-form__inputs">

                <div>
                    <label for="name">Technology Name</label>
                    <input required type="text" class="form-control" name="name" value="{{ $technology->name }}" />
                </div>
                <button type="submit" class="block px-2 py-1 mt-4 bg-green-500 rounded-full lg:px-4 hover:bg-green-600 text lg:text-sm">Save changes</button>
            </div>
        </form>
    </div>
@stop
