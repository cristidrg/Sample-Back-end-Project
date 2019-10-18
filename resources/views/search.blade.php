@extends('layout', [
    'a11y' => $a11y,
    'seo' => $seo,
    'perf' => $perf,
    'monitor' => $monitor,
])

@section('title', 'Home')

@section('content')
    <h1 class="props-header">Showing {{count($propResults) + count($orgResults)}} results</h1>
    <ul class="prop-list">
       @foreach ($propResults as $prop)
            <a class="prop-list__entry" href="/prop/{{$prop->id}}">
                <li class="prop-list__p-wrapper {{$prop->monitor->uptime_status == 'down' ? 'prop-list__down': ''}}">
                    {{$prop->title}}
                    <span class="prop-list__url">{{$prop->url}}</span>
                </li>
            </a>
        @endforeach
        @foreach ($orgResults as $org)
            <a class="prop-list__entry" href="/org/{{$org->id}}">
                <li class="prop-list__wrapper">
                    {{$org->title}} 
                    <span class="prop-list__count">{{count($org->children) + count($org->props)}}</span>
                </li>
            </a>
        @endforeach
    </ul>
@stop
