@extends('layout')

@section('title', 'Prop List')

@section('content')
    @if(session()->get('popup'))
        {{ session()->get('popup') }}  
    @endif
    <div>
        <a href="{{ route('prop.create') }}" class="btn">Create</a>
        <table class="table table-striped">
            <thead>
                <tr>
                    <td>ID</td>
                    <td>Title</td>
                    <td>URL</td>
                    <td>Parent Org Id</td>
                    <td>Technologies</td>
                    <td colspan = 2>Actions</td>
                </tr>
            </thead>
            <tbody>
                @foreach($props as $prop)
                <tr>
                    <td>{{$prop->id}}</td>
                    <td>{{$prop->title}}</td>
                    <td>{{$prop->url}}</td>
                    <td>{{$prop->org_id}}</td>
                    <td>
                        @foreach($prop->technologies as $technology)
                            {{$technology->name}} 
                        @endforeach
                    </td>
                    <td>
                        <a href="{{ route('prop.edit',$prop->id)}}" class="btn">Edit</a>
                    </td>
                    <td>
                        <form action="{{ route('prop.destroy', $prop->id)}}" method="post">
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
