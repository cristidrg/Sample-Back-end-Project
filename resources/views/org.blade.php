@extends('layout')

@section('title', 'Org')

@section('content')
    <div>
        <nav class="prop-page__breadcrumbs breadcrumb +icon +chevron">
         @if (isset($org->parent->parent->parent))
                <a href={{"/org/".$org->parent->parent->parent->id}}>{{$org->parent->parent->parent->title}}</a>
            @endif
            @if (isset($org->parent->parent))
                <a href={{"/org/".$org->parent->parent->id}}>{{$org->parent->parent->title}}</a>
            @endif
            <a href={{"/org/".$org->parent->id}}>{{$org->parent->title}}</a>
        </nav>
    </div>
    <h1 class="props-header">{{$org->title}}</h1>

    <div class="charts">
        <div class="charts__entry">
            <div class="charts__canvas-container">
                <canvas id="uptime"></canvas>
            </div>
            <label class="charts__label">Uptime</label>
        </div>
        <div class="charts__entry">
            <div class="charts__canvas-container">
                <canvas id="accessibility" data-score="{{$a11yScore}}""></canvas>
            </div>
            <label class="charts__label">Accessibility</label>
        </div>
    </div>

    <ul class="prop-list">
        @foreach ($childrenProps as $prop)
            <a class="prop-list__entry" href="/prop/{{$prop->id}}">
                <li class="prop-list__p-wrapper">
                    {{$prop->title}}
                    <span class="prop-list__url">{{$prop->url}}</span>
                </li>
            </a>
        @endforeach
        @foreach ($childrenOrgs as $childOrg)
            <a class="prop-list__entry" href="/org/{{$childOrg->id}}">
                <li class="prop-list__wrapper">
                    {{$childOrg->title}} 
                    <span class="prop-list__count">{{count($childOrg->children) + count($childOrg->props)}}</span>
                </li>
            </a>
        @endforeach
    </ul>
@stop