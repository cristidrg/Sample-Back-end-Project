@extends('layouts/default')

@section('title', 'User List')

@section('content')
    @if(session()->get('popup'))
        {{ session()->get('popup') }}  
    @endif
    <div>
        <a href="{{ route('user.create') }}" class="text-xl">Create</a>
        <table class="table table-striped">
            <thead>
                <tr>
                    <td>ID</td>
                    <td>First Name</td>
                    <td>Last Name</td>
                    <td>Email</td>
                    <td>Title</td>
                    <td>Orgs</td>
                    <td colspan = 2>Actions</td>
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
                    <td>
                        <a href="{{ route('user.edit',$user->id)}}"  class="text-xl">Edit</a>
                    </td>
                    <td>
                        <form action="{{ route('user.destroy', $user->id)}}" method="post">
                            @csrf
                            @method('DELETE')
                            <button  class="text-xl" type="submit">Delete</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@stop
