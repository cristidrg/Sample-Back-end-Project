@extends('layouts/default')

@section('title', 'Home')

@section('content')
    <h1 class="props-header">Overall Status of Northeastern Properties</h1>

    <div class="charts">
        <div class="charts__entry">
            <div class="charts__canvas-container">
                <canvas id="uptime" data-score="{{$uptimeScore}}"></canvas>
                @if ($uptimeScore < 1)
                    <span class="charts__warning">!</span>
                @else
                    <i class="charts__check" data-feather="check"></i>
                @endif
            </div>
            <label class="charts__label">Uptime</label>
        </div>
        <div class="charts__entry">
            <div class="charts__canvas-container">
                <canvas id="accessibility" data-score="{{$a11yScore}}"></canvas>
                <span class="charts__score {{$utils->getDigitClass($a11yScore)}} {{$utils->getColorClass($a11yScore)}}">{{$a11yScore }}</span>
            </div>
            <label class="charts__label">Accessibility</label>
        </div>
    </div>

    <ul class="prop-list">
     @foreach ($topLevelProps as $prop)
            <a class="prop-list__entry" href="/prop/{{$prop->id}}">
                <li class="prop-list__p-wrapper {{$prop->monitor->uptime_status == 'down' ? 'prop-list__down': ''}}">
                    {{$prop->title}}
                    <span class="prop-list__url">{{$prop->url}}</span>
                </li>
            </a>
        @endforeach
    </ul>

    <div class="flex flex-wrap">
        @foreach ($topLevelOrgs as $childOrg)
            <div class="w-1/4">
                @include('org.card')
            </div>
        @endforeach
    </div>
@stop
