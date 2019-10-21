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
        @if (isset($org->parent))
            <a href={{"/org/".$org->parent->id}}>{{$org->parent->title}}</a>
        @endif
    </nav>
    <h1 class="text-3xl font-bold text-gray-400">{{$org->title}}</h1>

    <p class="mt-24 text-lg text-gray-200 font-bold uppercase">Audit</p>
    <div class="bg-gray-800 mt-6 pt-10 pl-10 pr-8 pb-8">
        <div class="flex">
             @if ($org->getUptimeCount($org) > 0)
                <div class="flex items-center">
                    @include('svgs.check')
                    <p class="ml-2 text-sm font-light"><span class="text-lg font-bold">{{$org->getUptimeCount($org)}} </span> Properties</p>
                </div>
            @endif
            @if ($org->hasDownProps($org))
                <div class="flex items-center ml-10">
                    @include('svgs.warning')
                    <p class="ml-2 text-sm font-light"><span class="text-lg font-bold">{{$org->getPropCount($org) - $org->getUptimeCount($org)}} </span> Properties</p>
                </div>
            @endif
        </div>
        <div class="flex flex-col mt-8">
            <p class="text-gray-300">Accessibility</p>
            <div class="flex mt-1">
                <div class="flex-1 audit_bar h-5 bg-gray-700">
                    <span class="bg-blue-400" style="width: {{$a11yScore}}%"></span>
                </div>
                <p class="ml-6 text-large font-bold text-gray-200">{{$a11yScore}}</p>
            </div>
        </div>
        <div class="flex flex-col mt-4">
            <p class="text-gray-300">SEO</p>
            <div class="flex mt-1">
                <div class="flex-1 audit_bar h-5 bg-gray-700">
                    <span class="bg-blue-400" style="width: {{$seoScore}}%"></span>
                </div>
                <p class="ml-6 text-large font-bold text-gray-200">{{$seoScore}}</p>
            </div>
        </div>
        <div class="flex flex-col mt-4">
            <p class="text-gray-300">Performance</p>
            <div class="flex mt-1">
                <div class="flex-1 audit_bar h-5 bg-gray-700">
                    <span class="bg-blue-400" style="width: {{$perfScore}}%"></span>
                </div>
                <p class="ml-6 text-large font-bold text-gray-200">{{$perfScore}}</p>
            </div>
        </div>
    </div>

    @if (count($childrenProps) > 0)
        <p class="mt-24 mb-6 text-lg text-gray-200 font-bold uppercase">{{$org->title}} Properties</p>
        <ul>
            @foreach ($childrenProps as $prop)
                <a href="/prop/{{$prop->id}}">
                    <li class="flex pt-4 pb-4 border-b border-solid border-gray-700">
                        <div class="flex flex-col justify-center">
                            <p class="text-base font-medium text-gray-200 mb-1">{{$prop->title}}</p>
                            <p class="text-sm text-gray-700">{{$prop->url}}</p>
                        </div>
                        <div class="ml-auto flex items-baseline text-gray-400">
                            <div>
                                <p class="mb1">Accessibility</p>
                                <div class="audit_bar mt-4 h-2 w-32 bg-gray-700">
                                    <span class="bg-blue-400" style="width: {{$prop->$a11yScore}}%"></span>
                                </div>
                            </div>
                            <div class="ml-6">
                                <p class="mb1">SEO</p>
                                <div class="audit_bar mt-4 h-2 w-32 bg-gray-700">
                                    <span class="bg-blue-400" style="width: {{$prop->$seoScore}}%"></span>
                                </div>
                            </div>
                            <div class="ml-6">
                                <p class="mb1">Performance</p>
                                <div class="audit_bar mt-4 h-2 w-32 bg-gray-700">
                                    <span class="bg-blue-400" style="width: {{$prop->$perfScore}}%"></span>
                                </div>
                            </div>
                        </div>
                        <div class="ml-12 flex flex-col items-center">
                            <p class="mb-1 text-gray-400">Uptime</p>
                            @if($prop->monitor->uptime_status == 'down')
                                @include('svgs.warning')
                            @else
                                @include('svgs.check')
                            @endif
                        </div>
                    </li>
                </a>
            @endforeach
        </ul>
    @endif

    @if (count($childrenOrgs) > 0)
        <p class="mt-24 mb-6 text-lg text-gray-200 font-bold uppercase">{{$org->title}} Organizations</p>
        <ul class="flex flex-wrap justify-between">
            @foreach ($childrenOrgs as $childOrg)
                <a href="/org/{{$childOrg->id}}">
                    <li class="flex flex-col w-56 pt-6 pb-6 pl-4 pr-4 mb-8 bg-gray-800">
                        <h1 class="h-8">{{$childOrg->title}}</h1>
                        <div class="h-24">
                            @if ($childOrg->getUptimeCount($childOrg) > 0)
                            <div class="mt-4 flex items-center">
                                @include('svgs.check')
                                <p class="ml-2 text-sm font-light"><span class="text-lg font-bold">{{$childOrg->getUptimeCount($childOrg)}} </span> Properties</p>
                            </div>
                            @endif
                            @if ($childOrg->hasDownProps($childOrg))
                                <div class="mt-4 flex items-center">
                                    @include('svgs.warning')
                                    <p class="ml-2 text-sm font-light"><span class="text-lg font-bold">{{$childOrg->getPropCount($childOrg) - $childOrg->getUptimeCount($childOrg)}} </span> Properties</p>
                                </div>
                            @endif
                        </div>
                        <div class="mt-auto flex flex-col text-gray-400">
                            <div>
                                <p class="mb1">Accessibility</p>
                                <div class="audit_bar mt-2 h-1 bg-gray-700">
                                    <span class="bg-blue-400" style="width: {{$childOrg->getA11yScore()}}%"></span>
                                </div>
                            </div>
                            <div class="mt-4">
                                <p class="mb1">SEO</p>
                                <div class="audit_bar mt-2 h-1 bg-gray-700">
                                    <span class="bg-blue-400" style="width: {{$childOrg->getSeoScore()}}%"></span>
                                </div>
                            </div>
                            <div class="mt-4">
                                <p class="mb1">Performance</p>
                                <div class="audit_bar mt-2 h-1 bg-gray-700">
                                    <span class="bg-blue-400" style="width: {{$childOrg->getPerfScore()}}%"></span>
                                </div>
                            </div>
                        </div>
                    </li>
                </a>
            @endforeach
        </ul>
    @endif
    {{-- <ul class="prop-list">
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
    </ul> --}}
@stop
