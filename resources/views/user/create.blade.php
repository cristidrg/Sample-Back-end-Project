@extends('layout')

@section('title', 'Create User')

@section('content')
    <div>
        @if(session()->get('popup'))
            {{ session()->get('popup') }}  
        @endif
        <form method="post" action={{ route('user.store') }}>
            @csrf
            <div>
                <label for="first_name">First name</label>
                <input required type="text" class="form-control" name="first_name" />
            </div>
            <div>
                @csrf
                <label for="last_name">Last name</label>
                <input required type="text" class="form-control" name="last_name" />
            </div>
            <div>
                @csrf
                <label for="email">Email</label>
                <input required type="text" class="form-control" name="email" />
            </div>
            <div>
                @csrf
                <label for="title">Title</label>
                <input required type="text" class="form-control" name="title" />
            </div>
            <div>
                <label for="maintains_org">Maintaining Org:</label>
                <select name="maintains_org"  class="text-black">
                    @foreach ($orgs as $org)
                        <option>{{$org->title}}</option>
                    @endforeach
                </select>
            </div>
            <button type="submit"  class="text-xl">Add</button>
        </form>
    </div>
@stop
