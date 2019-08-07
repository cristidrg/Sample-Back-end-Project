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
            <a href="/prop/{{$prop->id}}">
                <li class="prop">
                    {{$prop->title}}
                    {{$prop->url}}
                </li>
            </a>
        @endforeach
        @foreach ($topLevelOrgs as $org)
            <a class="prop-list__entry" href="/org/{{$org->id}}">
                <li class="prop-list__wrapper">
                    {{$org->title}} 
                    <span class="prop-list__count">{{count($org->children) + count($org->props)}}</span>
                </li>
            </a>
        @endforeach
    </ul>
@stop
