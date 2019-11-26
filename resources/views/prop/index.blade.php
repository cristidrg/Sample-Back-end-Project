@extends('layout-tables')

@section('title', 'Prop List')

@section('content')
    @if(session()->get('popup'))
        {{ session()->get('popup') }}  
    @endif
    <div class="flex flex-col flex-wrap">
        <div class="flex items-center mobile-only:w-full lg:pr-2">
            <h1 class="mb-5 text-3xl font-bold">Northeastern Properties</h1>
            <a class="px-4 py-1 ml-auto bg-green-500 rounded-full text-md" href="{{ route('prop.create') }}"">Create New Property</a>
        </div>
        <div class="mobile-only:overflow-auto mobile-only:w-full pr-2">
            <table class="table w-full table-auto table-striped table-responsive props-table">
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
                        <td class="flex py-1 text-sm">
                            <a href="{{ route('prop.edit',$prop->id)}}" class="px-2 mr-2 bg-blue-500 rounded-full">Edit</a>
                            <form action="{{ route('prop.destroy', $prop->id)}}" method="post">
                                @csrf
                                @method('DELETE')
                                <button class="px-2 bg-red-500 rounded-full" type="submit">Delete</button>
                            </form>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@stop
