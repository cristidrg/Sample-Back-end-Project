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
        <form method="post" action={{ route('technology.update', $technology->id) }}>
            @method('PATCH') 
            @csrf
            <div>
                <label for="name">Technology Name:</label>
                <input required type="text" class="form-control" name="name" value="{{ $technology->name }}" />
            </div>
            <button type="submit">Update</button>
        </form>
    </div>
@stop
