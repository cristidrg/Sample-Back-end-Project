@extends('layout')

@section('title', 'Home')

@section('content')
    <h1 class="props-header">Overall Status of Northeastern Properties</h1>

    <div class="charts">
        <div class="charts__entry">
            <div class="charts__canvas-container">
                <canvas id="uptime"></canvas>
            </div>
            <label class="charts__label">Uptime</label>
        </div>
        <div class="charts__entry">
            <div class="charts__canvas-container">
                <canvas id="accessibility"></canvas>
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
        @foreach ($topLevelOrgs as $childOrg)
            <a class="prop-list__entry {{$childOrg->hasDownProps($childOrg) ? 'prop-list__down-org': ''}}" href="/org/{{$childOrg->id}}">
                <li class="prop-list__wrapper">
                    {{$childOrg->title}} 
                    <span class="prop-list__count">{{count($childOrg->children) + count($childOrg->props)}}</span>
                </li>
            </a>
        @endforeach
    </ul>
@stop
