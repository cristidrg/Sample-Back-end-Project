@extends('layout')

@section('title', 'Org')

@section('content')
    @if(session()->get('popup'))
        {{ session()->get('popup') }}  
    @endif
    <div>
        <table class="table table-striped">
            <thead>
                <tr>
                    <td>ID</td>
                    <td>Title</td>
                    <td>Description</td>
                    <td>Parent ID</td>
                    <td colspan = 2>Actions</td>
                </tr>
            </thead>
            <tbody>
                @foreach($orgs as $org)
                <tr>
                    <td>{{$org->id}}</td>
                    <td>{{$org->title}}</td>
                    <td>{{$org->description}}</td>
                    <td>{{$org->parent_id}}</td>
                    <td>
                        <a href="{{ route('org.edit',$org->id)}}" class="btn">Edit</a>
                    </td>
                    <td>
                        <form action="{{ route('org.destroy', $org->id)}}" method="post">
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
