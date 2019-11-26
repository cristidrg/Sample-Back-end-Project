@extends('layouts/tables')

@section('title', 'User List')

@section('content')
    <div>
        @if(session()->get('popup'))
            {{ session()->get('popup') }}  
        @endif
    </div>
    <div class="flex lg:inline-flex flex-col flex-wrap">
        <div class="flex items-center mb-2  mobile-only:w-full lg:pr-2">
            <h1 class="text-lg lg:text-3xl font-bold">NUProps Users</h1>
            <a class="px-2 lg:px-4 py-1 ml-auto bg-green-500 rounded-full text-xs hover:bg-green-600 lg:text-sm" href="{{ route('user.create') }}"">Create New User</a>
        </div>
        <div class="mobile-only:overflow-auto mobile-only:w-full pr-2">
            <table class="table table-auto table-striped table-responsive text-sm props-table">
                <thead>
                    <tr>
                        <td>ID</td>
                        <td>First Name</td>
                        <td>Last Name</td>
                        <td>Email</td>
                        <td>Title</td>
                        <td>Orgs</td>
                        <td>Actions</td>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $user)
                    <tr>
                        <td>{{$user->id}}</td>
                        <td>{{$user->first_name}}</td>
                        <td>{{$user->last_name}}</td>
                        <td>{{$user->email}}</td>
                        <td>{{$user->title}}</td>
                        <td> 
                            @foreach ($user->orgs as $org)
                                {{$org->id}} 
                            @endforeach
                        </td>
                        <td class="flex py-1 text-sm justify-around">
                            <a href="{{ route('user.edit',$user->id)}}" class="px-2 mr-2 hover:bg-blue-600 bg-blue-500 rounded-full">Edit</a>
                            <form action="{{ route('user.destroy', $user->id)}}" method="post">
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
