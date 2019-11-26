@extends('layouts/default')

@section('title', 'Create User')

@section('content')
    <div>
        <h1 class="mb-4 text-2xl font-bold">Create new user</h1>
        <form class="text-base props-form__create" method="post" action={{ route('user.store') }}>
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
                    <select name="maintains_orgs[]" multiple class="h-40 text-black">
                        @foreach ($orgs as $org)
                            <option>{{$org->title}}</option>
                        @endforeach
                    </select>
                </div>
                <button type="submit" class="block px-2 py-1 mt-4 bg-green-500 rounded-full lg:px-4 hover:bg-green-600 text lg:text-sm">Add</button>
            </div>
        </form>
    </div>
@stop
