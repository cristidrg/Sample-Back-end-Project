@extends('layouts/default')

@section('title', 'Create Org')

@section('content')
    <div>
        <h1 class="text-2xl mb-4 font-bold">Create new organization</h1>
        <form class="props-form__create text-base" method="post" action={{ route('org.store') }}>
            <div class="props-form__inputs">
                <div>
                    @csrf
                    <label for="org_title">Org Title</label>
                    <input required type="text" class="form-control" name="org_title" />
                </div>
                <div>
                    <label for="org_parent">Org Parent</label>
                    <select name="org_parent" class="text-black">
                        @foreach ($orgs as $org)
                            <option>{{$org->title}}</option>
                        @endforeach
                    </select>
                </div>
                <button type="submit"  class="block px-2 lg:px-4 mt-4 py-1 bg-green-500 hover:bg-green-600 rounded-full text lg:text-sm">Create org</button>
            </div>
        </form>
    </div>
@stop
