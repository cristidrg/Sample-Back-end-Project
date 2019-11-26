@extends('layouts/default')

@section('title', 'Create Org')

@section('content')
    <div>
        <h1 class="mb-4 text-2xl font-bold">Create new organization</h1>
        <form class="text-base props-form__create" method="post" action={{ route('org.store') }}>
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
                <button type="submit"  class="block px-2 py-1 mt-4 bg-green-500 rounded-full lg:px-4 hover:bg-green-600 text lg:text-sm">Create org</button>
            </div>
        </form>
    </div>
@stop
