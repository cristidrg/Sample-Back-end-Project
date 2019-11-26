@extends('layouts/tables')

@section('title', 'Technology List')

@section('content')
    <div>
        @if(session()->get('popup'))
            {{ session()->get('popup') }}  
        @endif
    </div>
    <div class="flex flex-col flex-wrap lg:inline-flex">
        <div class="flex items-center w-full mb-2 lg:pr-2">
            <h1 class="text-lg font-bold lg:text-3xl">Technologies</h1>
            <a class="px-2 py-1 ml-5 text-xs bg-green-500 rounded-full lg:px-4 hover:bg-green-600 lg:text-sm" href="{{ route('technology.create') }}"">Create New Technology</a>
        </div>
        <div class="pr-2 mobile-only:overflow-auto mobile-only:w-full">
            <table class="table text-sm table-auto table-striped table-responsive props-table">
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
                    <td class="flex justify-around py-1 text-sm">
                        <a href="{{ route('technology.edit',$technology->id)}}" class="px-2 mr-2 bg-blue-500 rounded-full hover:bg-blue-600">Edit</a>
                        <form action="{{ route('technology.destroy', $technology->id)}}" method="post">
                            @csrf
                            @method('DELETE')
                            <button class="px-2 bg-red-500 rounded-full hover:bg-red-600" type="submit">Delete</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
            </table>
        </div>
    </div>
@stop
