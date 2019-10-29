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

    <p class="mt-8 lg:mt-24 text-lg text-gray-200 font-bold uppercase">Audits</p>
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
                    <span class="bg-blue-400" style="width: {{$a11yScore * 100}}%"></span>
                </div>
                <p class="ml-6 text-large font-bold text-gray-200">{{$a11yScore * 100}}</p>
            </div>
        </div>
        <div class="flex flex-col mt-4">
            <p class="text-gray-300">SEO</p>
            <div class="flex mt-1">
                <div class="flex-1 audit_bar h-5 bg-gray-700">
                    <span class="bg-blue-400" style="width: {{$seoScore * 100}}%"></span>
                </div>
                <p class="ml-6 text-large font-bold text-gray-200">{{$seoScore * 100}}</p>
            </div>
        </div>
        <div class="flex flex-col mt-4">
            <p class="text-gray-300">Performance</p>
            <div class="flex mt-1">
                <div class="flex-1 audit_bar h-5 bg-gray-700">
                    <span class="bg-blue-400" style="width: {{$perfScore * 100}}%"></span>
                </div>
                <p class="ml-6 text-large font-bold text-gray-200">{{$perfScore * 100}}</p>
            </div>
        </div>
    </div>

    @if (count($childrenProps) > 0)
        <p class="mt-12 lg:mt-24 mb-6 text-lg text-gray-200 font-bold uppercase">{{$org->title}} Properties</p>
        <ul>
            @foreach ($childrenProps as $prop)
                <li class="block px-2 border-b border-solid border-gray-800 hover:bg-gray-800 ">
                    <a class="flex flex-col lg:flex-row pt-4 pb-4 relative" href="/prop/{{$prop->id}}">
                        <div class="flex flex-col justify-center">
                            <p class="text-base font-medium text-gray-200 mb-1">{{$prop->title}}</p>
                            <p class="text-sm text-gray-700">{{$prop->url}}</p>
                        </div>
                        <div class="flex items-center text-gray-500 mt-6 lg:mt-0 lg:ml-auto">
                            <div class="flex-1">
                                <p class="mb1">Accessibility</p>
                                <div class="audit_bar mt-4 h-2 w-full lg:w-32 bg-gray-700">
                                    <span class="bg-blue-400" style="width: {{$prop->a11yScore * 100}}%"></span>
                                </div>
                            </div>
                            <div class="flex-1 ml-6">
                                <p class="mb1">SEO</p>
                                <div class="audit_bar mt-4 h-2 w-full lg:w-32 bg-gray-700">
                                    <span class="bg-blue-400" style="width: {{$prop->seoScore * 100}}%"></span>
                                </div>
                            </div>
                            <div class="flex-1 ml-6">
                                <p class="mb1">Performance</p>
                                <div class="audit_bar mt-4 h-2 w-full lg:w-32 bg-gray-700">
                                    <span class="bg-blue-400" style="width: {{$prop->perfScore * 100}}%"></span>
                                </div>
                            </div>
                        </div>
                        <div class="ml-12 flex flex-col items-center absolute lg:static top-1 lg:top-auto right-0">
                            <p class="mb-1 text-gray-500">Uptime</p>
                            @if($prop->monitor->uptime_status == 'down')
                                @include('svgs.warning')
                            @else
                                @include('svgs.check')
                            @endif
                        </div>
                    </a>
                </li>
            @endforeach
        </ul>
    @endif

    @if (count($childrenOrgs) > 0)
        <p class="mt-12 lg:mt-24 mb-6 text-lg text-gray-200 font-bold uppercase">{{$org->title}} Organizations</p>
        <div class="flex flex-wrap justify-between">
            @foreach ($childrenOrgs as $childOrg)
                @include('org.card')
            @endforeach
        </div>
    @endif
@stop
