@extends('layouts/tables')

@section('title', 'Prop List')

@section('content')
    <div>
        @if(session()->get('popup'))
            {{ session()->get('popup') }}  
        @endif
    </div>
    <div class="flex flex-col flex-wrap">
        <div class="flex items-center mb-2  mobile-only:w-full lg:pr-2">
            <h1 class="text-lg lg:text-3xl font-bold">Northeastern Properties</h1>
            <a class="px-2 lg:px-4 py-1 ml-auto bg-green-500 hover:bg-green-600 rounded-full text-xs lg:text-sm" href="{{ route('prop.create') }}"">Create New Property</a>
        </div>
        <div class="mobile-only:overflow-auto mobile-only:w-full pr-2">
            <table class="table w-full table-auto table-striped table-responsive text-sm props-table">
                <thead>
                    <tr>
                        <td>ID</td>
                        <td>Title</td>
                        <td>URL</td>
                        <td>Technologies</td>
                        <td class="props-table_parent-id">Parent Id</td>
                        <td>Actions</td>
                    </tr>
                </thead>
                <tbody>
                    @foreach($props as $prop)
                    <tr>
                        <td>{{$prop->id}}</td>
                        <td>{{$prop->title}}</td>
                        <td><a class="text-blue-300" href="{{$prop->url}}" target="_blank">{{$prop->url}}</a></td>
                        <td>@foreach($prop->technologies as $index=>$technology){{$index > 0 ? ',' : ''}} {{$technology->name}}@endforeach</td>
                        <td class="props-table_parent-id">{{$prop->org_id}}</td>
                        <td class="flex py-1 text-sm justify-around">
                            <a href="{{ route('prop.edit',$prop->id)}}" class="px-2 mr-2 hover:bg-blue-600 bg-blue-500 rounded-full">Edit</a>
                            <form action="{{ route('prop.destroy', $prop->id)}}" method="post">
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
