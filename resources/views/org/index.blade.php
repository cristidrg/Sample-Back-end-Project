@extends('layouts/tables')

@section('title', 'Org List')

@section('content')
    <div>
        @if(session()->get('popup'))
            {{ session()->get('popup') }}  
        @endif
    </div>
    <div class="flex flex-col flex-wrap lg:inline-flex">
        <div class="flex items-center mb-2 mobile-only:w-full lg:pr-2">
            <h1 class="text-lg font-bold lg:text-3xl">Northeastern Organizations</h1>
            <a class="px-2 py-1 ml-auto text-xs bg-green-500 rounded-full lg:px-4 hover:bg-green-600 lg:text-sm" href="{{ route('org.create') }}"">Create New Organization</a>
        </div>
        <div class="pr-2 mobile-only:overflow-auto mobile-only:w-full">
            <table class="table text-sm table-auto table-striped table-responsive props-table">
                <thead>
                    <tr>
                        <td>ID</td>
                        <td>Title</td>
                        <td class="props-table_parent-id">Parent ID</td>
                        <td>Contact email</td>
                        <td>Actions</td>
                    </tr>
                </thead>
                <tbody>
                    @foreach($orgs as $org)
                    <tr>
                        <td>{{$org->id}}</td>
                        <td>{{$org->title}}</td>
                        <td class="props-table_parent-id">{{$org->parent_id  ? $org->parent_id : 'Root'}}</td>
                        <td>{{count($org->users) > 0 ? array_column($org->users->toArray(), 'email')[0] : ''}}</td>
                        <td class="flex justify-around py-1 text-sm">
                            <a href="{{ route('org.edit',$org->id)}}" class="px-2 mr-2 bg-blue-500 rounded-full hover:bg-blue-600">Edit</a>
                            <form action="{{ route('org.destroy', $org->id)}}" method="post">
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
