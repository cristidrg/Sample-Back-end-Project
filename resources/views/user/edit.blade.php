@extends('layout')

@section('title', 'Edit User')

@section('content')
    <div>
        <form method="post" action={{ route('user.update', $user->id) }}>
            @method('PATCH') 
            @csrf
            <div>
                <label for="first_name">First name</label>
                <input required type="text" class="form-control" name="first_name" value="{{ $user->first_name }}"/>
            </div>
            <div>
                @csrf
                <label for="last_name">Last name</label>
                <input required type="text" class="form-control" name="last_name" value="{{ $user->last_name }}"/>
            </div>
            <div>
                @csrf
                <label for="email">Email</label>
                <input required type="text" class="form-control" name="email" value="{{ $user->email }}"/>
            </div>
            <div>
                @csrf
                <label for="title">Title</label>
                <input required type="text" class="form-control" name="title" value="{{ $user->title }}"/>
            </div>
            <div>
                @csrf
                <label for="maintaining_org">Maintaining Org</label>
                <select name="maintaining_org" value="{{$maintaining_org}}" class="text-black">
                    @foreach ($orgs as $org)
                        @if ($org->title == $maintaining_org)
                            <option selected>{{$org->title}}</option>
                        @else
                            <option>{{$org->title}}</option>
                        @endif
                    @endforeach
                </select>
            </div>
            <button type="submit" class="text-xl">Update</button>
        </form>
    </div>
@stop
