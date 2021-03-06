@extends('layouts/default')

@section('title', 'Edit User')

@section('content')
    <div>
        @if ($errors->any())
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        @endif
        <h1 class="mb-4 text-2xl font-bold">Edit User {{$user->email}}</h1>
        <form class="text-base props-form__create" method="post" action={{ route('user.update', $user->id) }}>
            @method('PATCH') 
            @csrf
            <div class="props-form__inputs">

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
                    <label for="maintains_orgs[]">Maintaining Orgs:</label>
                    <select name="maintains_orgs[]" multiple class="h-40 text-black">
                        @foreach ($orgs as $org)
                            @if (in_array($org->title, array_column(json_decode($user->orgs), 'title')))
                                <option selected>{{$org->title}}</option>
                            @else
                                <option>{{$org->title}}</option>
                            @endif
                        @endforeach
                    </select>
                </div>
                <button type="submit" class="block px-2 py-1 mt-4 bg-green-500 rounded-full lg:px-4 hover:bg-green-600 text lg:text-sm">Save changes</button>
            </div>
        </form>
    </div>
@stop
