@extends('layouts/tables')

@section('title', 'Technology List')

@section('content')
    <div>
        @if(session()->get('popup'))
            {{ session()->get('popup') }}  
        @endif
    </div>
    <div class="flex lg:inline-flex flex-col flex-wrap">
        <div class="flex items-center mb-2 w-full lg:pr-2">
            <h1 class="text-lg lg:text-3xl font-bold">Technologies</h1>
            <a class="px-2 lg:px-4 py-1 ml-5 bg-green-500 rounded-full text-xs hover:bg-green-600 lg:text-sm" href="{{ route('technology.create') }}"">Create New Technology</a>
        </div>
        <div class="mobile-only:overflow-auto mobile-only:w-full pr-2">
            <table class="table table-auto table-striped table-responsive text-sm props-table">
                <thead>
                <tr>
                    <td>ID</td>
                    <td>Name</td>
                    <td>Actions</td>
                </tr>
            </thead>
            <tbody>
                @foreach($technologies as $technology)
                <tr>
                    <td>{{$technology->id}}</td>
                    <td>{{$technology->name}}</td>
                    <td class="flex py-1 text-sm justify-around">
                        <a href="{{ route('technology.edit',$technology->id)}}" class="px-2 mr-2 hover:bg-blue-600 bg-blue-500 rounded-full">Edit</a>
                        <form action="{{ route('technology.destroy', $technology->id)}}" method="post">
                            @csrf
                            @method('DELETE')
                            <button class="px-2 hover:bg-red-600 bg-red-500 rounded-full" type="submit">Delete</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
            </table>
        </div>
    </div>
@stop
