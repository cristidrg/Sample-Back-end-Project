@extends('layout')

@section('title', $org->title)

@section('content')
    <nav class="text-base font-regular text-gray-500 mb-1">
        @if (isset($org->parent->parent->parent))
            <a href={{"/org/".$org->parent->parent->parent->id}}>{{$org->parent->parent->parent->title}}</a> /
        @endif
        @if (isset($org->parent->parent))
            <a href={{"/org/".$org->parent->parent->id}}>{{$org->parent->parent->title}}</a> / 
        @endif
        <a href={{"/org/".$org->parent->id}}>{{$org->parent->title}}</a>
    </nav>
    <h1 class="text-3xl font-bold text-gray-400">{{$org->title}}</h1>

    <p class="mt-32 text-base text-gray-200 font-bold uppercase">Audit</p>
    <div class="bg-gray-800">
        <div class="flex">
            <p>✓ <span class="font-bold">55</span> Properties</p>
            <p class="ml-10">X <span class="font-bold">1</span> Properties</p>
        </div>
        
    </div>
    <div class="charts">
        <div class="charts__entry">
            <div class="charts__canvas-container charts__uptime">
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
                <canvas id="accessibility" data-score="{{$a11yScore}}""></canvas>
                <span class="charts__score {{$utils->getDigitClass($a11yScore)}} {{$utils->getColorClass($a11yScore)}}">{{$a11yScore * 100}}</span>
            </div>
            <label class="charts__label">Accessibility</label>
        </div>
    </div>

    <ul class="prop-list">
        @foreach ($childrenProps as $prop)
            <a class="prop-list__entry" href="/prop/{{$prop->id}}">
                <li class="prop-list__p-wrapper {{$prop->monitor->uptime_status == 'down' ? 'prop-list__down': ''}}">
                    {{$prop->title}}
                    <span class="prop-list__url">{{$prop->url}}</span>
                </li>
            </a>
        @endforeach
        @foreach ($childrenOrgs as $childOrg)
            <a class="prop-list__entry {{$childOrg->hasDownProps($childOrg) ? 'prop-list__down-org': ''}}" href="/org/{{$childOrg->id}}">
                <li class="prop-list__wrapper">
                    {{$childOrg->title}} 
                    <span class="prop-list__count">{{$childOrg->getPropCount($childOrg)}}</span>
                </li>
            </a>
        @endforeach
    </ul>
@stop
