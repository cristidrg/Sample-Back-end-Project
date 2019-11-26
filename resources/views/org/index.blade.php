@extends('layouts/tables')

@section('title', 'Org List')

@section('content')
    <div>
        @if(session()->get('popup'))
            {{ session()->get('popup') }}  
        @endif
    </div>
    <div class="flex lg:inline-flex flex-col flex-wrap">
        <div class="flex items-center mb-2  mobile-only:w-full lg:pr-2">
            <h1 class="text-lg lg:text-3xl font-bold">Northeastern Organizations</h1>
            <a class="px-2 lg:px-4 py-1 ml-auto bg-green-500 rounded-full text-xs hover:bg-green-600 lg:text-sm" href="{{ route('org.create') }}"">Create New Organization</a>
        </div>
        <div class="mobile-only:overflow-auto mobile-only:w-full pr-2">
            <table class="table table-auto table-striped table-responsive text-sm props-table">
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
                        <td class="flex py-1 text-sm justify-around">
                            <a href="{{ route('org.edit',$org->id)}}" class="px-2 mr-2 hover:bg-blue-600 bg-blue-500 rounded-full">Edit</a>
                            <form action="{{ route('org.destroy', $org->id)}}" method="post">
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
