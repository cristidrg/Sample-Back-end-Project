@extends('layouts/default')

@section('title', 'Org List')

@section('content')
    @if(session()->get('popup'))
        {{ session()->get('popup') }}  
    @endif
    <div>
        <a href="{{ route('org.create') }}"  class="text-xl">Create</a>
        <table class="table table-striped">
            <thead>
                <tr>
                    <td>ID</td>
                    <td>Title</td>
                    <td>Parent ID</td>
                    <td>Contact email</td>
                    <td colspan = 2>Actions</td>
                </tr>
            </thead>
            <tbody>
                @foreach($orgs as $org)
                <tr>
                    <td>{{$org->id}}</td>
                    <td>{{$org->title}}</td>
                    <td>{{$org->parent_id}}</td>
                    <td>{{$org->contact ? $org->contact->email : ''}}</td>
                    <td>
                        <a href="{{ route('org.edit',$org->id)}}"  class="text-xl">Edit</a>
                    </td>
                    <td>
                        <form action="{{ route('org.destroy', $org->id)}}" method="post">
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
