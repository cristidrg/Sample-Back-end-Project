@extends('layout', [
    'a11y_green' => $a11y_green,
    'a11y_yellow' => $a11y_yellow,
    'a11y_red' => $a11y_red,
    'seo_green' => $seo_green,
    'seo_yellow' => $seo_yellow,
    'seo_red' => $seo_red,
    'perf_green' => $perf_green,
    'perf_yellow' => $perf_yellow,
    'perf_red' => $perf_red,
    'monitor_up' => $monitor_up,
    'monitor_down' => $monitor_down,
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
