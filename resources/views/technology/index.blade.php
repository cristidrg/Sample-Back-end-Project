@extends('layout')

@section('title', 'Technology List')

@section('content')
    @if(session()->get('popup'))
        {{ session()->get('popup') }}  
    @endif
    <div>
        <a href="{{ route('technology.create') }}" class="btn">Create</a>
        <table class="table table-striped">
            <thead>
                <tr>
                    <td>ID</td>
                    <td>Name</td>
                    <td colspan = 2>Actions</td>
                </tr>
            </thead>
            <tbody>
                @foreach($technologies as $technology)
                <tr>
                    <td>{{$technology->id}}</td>
                    <td>{{$technology->name}}</td>
                    <td>
                        <a href="{{ route('technology.edit',$technology->id)}}" class="btn">Edit</a>
                    </td>
                    <td>
                        <form action="{{ route('technology.destroy', $technology->id)}}" method="post">
                            @csrf
                            @method('DELETE')
                            <button class="btn" type="submit">Delete</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@stop
