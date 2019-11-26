@extends('layouts/default')

@section('title', 'Create User')

@section('content')
    <div>
        <h1 class="text-2xl mb-4 font-bold">Create new user</h1>
        <form class="props-form__create text-base" method="post" action={{ route('user.store') }}>
            @csrf
            <div class="props-form__inputs">
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
                    <label for="maintains_orgs[]">Maintaining Orgs:</label>
                    <select name="maintains_orgs[]" multiple class="text-black h-40">
                        @foreach ($orgs as $org)
                            <option>{{$org->title}}</option>
                        @endforeach
                    </select>
                </div>
                <button type="submit" class="block px-2 lg:px-4 mt-4 py-1 bg-green-500 hover:bg-green-600 rounded-full text lg:text-sm">Add</button>
            </div>
        </form>
    </div>
@stop
