@extends('layouts/default')

@section('title', $prop->title)

@section('content')
    <nav class="mb-1 text-base text-gray-500 font-regular">
        @if (isset($prop->org->parent->parent->parent))
            <a href={{"/org/".$prop->org->parent->parent->parent->id}}>{{$prop->org->parent->parent->parent->title}}</a> /
        @endif
        @if (isset($prop->org->parent->parent))
            <a href={{"/org/".$prop->org->parent->parent->id}}>{{$prop->org->parent->parent->title}}</a> /
        @endif
        @if (isset($prop->org->parent))
            <a href={{"/org/".$prop->org->parent->id}}>{{$prop->org->parent->title}}</a> /
        @endif
        <a href={{"/org/".$prop->org->id}}>{{$prop->org->title}}</a>
    </nav>
    <div class="flex items-center">
        <h1 class="text-3xl font-bold text-gray-400">{{$prop->title}}</h1>
        <a class="px-3 py-1 mt-2 ml-12 text-xs text-black bg-gray-300 rounded-full" href="{{$prop->url}}">Visit Site</a>
    </div>
    <div class="flex flex-wrap mb-24">
        <div class="flex-grow w-full mt-12 lg:w-7/12">
            <p class="text-lg font-bold text-gray-200 uppercase">Audit</p>
            <div class="py-10 pl-10 pr-8 mt-6 bg-gray-800">
                <div class="flex flex-col">
                    <p class="text-gray-300">Accessibility</p>
                    <div class="flex mt-1">
                        <div class="flex-1 h-5 bg-gray-700 audit_bar">
                            <span class="bg-blue-400" style="width: {{$prop->a11yScore }}%"></span>
                        </div>
                        <p class="ml-6 font-bold text-gray-200 text-large">{{$prop->a11yScore }}</p>
                    </div>
                </div>
                <div class="flex flex-col mt-4">
                    <p class="text-gray-300">SEO</p>
                    <div class="flex mt-1">
                        <div class="flex-1 h-5 bg-gray-700 audit_bar">
                            <span class="bg-blue-400" style="width: {{$prop->seoScore }}%"></span>
                        </div>
                        <p class="ml-6 font-bold text-gray-200 text-large">{{$prop->seoScore }}</p>
                    </div>
                </div>
                <div class="flex flex-col mt-4">
                    <p class="text-gray-300">Performance</p>
                    <div class="flex mt-1">
                        <div class="flex-1 h-5 bg-gray-700 audit_bar">
                            <span class="bg-blue-400" style="width: {{$prop->perfScore }}%"></span>
                        </div>
                        <p class="ml-6 font-bold text-gray-200 text-large">{{$prop->perfScore }}</p>
                    </div>
                </div>
                <div class="flex flex-col mt-4">
                    <p class="text-gray-300">Security</p>
                    <div class="flex mt-1">
                        <div class="flex-1 h-5 bg-gray-700 audit_bar">
                            <span class="bg-blue-400" style="width: {{$prop->securityScore }}%"></span>
                        </div>
                        <p class="ml-6 font-bold text-gray-200 text-large">{{$prop->securityScore }}</p>
                    </div>
                </div>
                <div class="flex items-center mt-8">
                    @if($prop->monitor->uptime_status == 'down')
                        <div class="flex items-center px-2 py-1 text-xs text-gray-100 bg-red-500 rounded-full prop_status">
                                @include('svgs/warning')
                            <p class="ml-2">Property Down</p>
                        </div>
                    @else
                        <div class="flex items-center px-2 py-1 text-xs text-gray-100 bg-green-500 rounded-full prop_status">
                            @include('svgs/check')
                            <p class="ml-2">Property Up</p>
                        </div>
                    @endif
                    <p class="ml-auto text-sm text-gray-500">Last performed: {{$prop->monitor->uptime_last_check_date}}</p>
                    <a href="/audits/{{$prop->id}}.html" class="px-2 py-2 ml-5 text-xs bg-gray-700">Full Lighthouse report</a>
                </div>
            </div>
        </div>
        <div class="flex flex-col w-full mt-12 lg:w-3/12 lg:ml-8">
            <p class="text-lg font-bold text-gray-200 uppercase">Contact</p>
            <div class="flex-grow h-full py-2 pl-10 pr-8 mt-6 bg-blue-900">
                @foreach ($contacts as $contact)
                    <div class="mt-6">
                        <p>{{$contact->first_name}} {{$contact->last_name}}</p>
                        <p class="font-light text-m">{{$contact->title}}</p>
                        <p class="mt-3 font-light text-gray-500 text-m">{{$contact->email}}</p>
                    </div>
                @endforeach
            </div>
        </div>
        <div class="flex flex-col flex-grow w-full mt-12 lg:w-7/12">
            <p class="text-lg font-bold text-gray-200 uppercase">Environment</p>
            <div class="flex h-full py-8 pl-10 pr-8 mt-6 text-xs font-light bg-gray-800">
                @foreach ($prop->environments as $index=>$environment)
                    @if ($index == 0)
                        <div>
                    @else
                        <div class="ml-8">
                    @endif
                            <p class="text-base font-medium">{{$environment['type']}}</p>
                            <p class="mt-2 uppercase">Server:</p>
                            <a class="text-blue-300" href="{{$environment['server']}}">{{$environment['server']}}</a>
                            <p class="mt-2">URL:</p> 
                            <a class="text-blue-300" href="{{$environment['url']}}">{{$environment['url']}}</a>
                        </div>
                @endforeach
            </div>
        </div>
        <div class="flex flex-col w-full mt-12 lg:w-3/12 lg:ml-8">
            <p class="text-lg font-bold text-gray-200 uppercase">Technology</p>
            <div class="h-full py-8 pl-10 pr-8 mt-6 bg-gray-800">
                <ul>
                    @foreach ($prop->technologies as $technology)
                        <li>{{$technology->name}}</li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>

    <a href={{"/prop"."/".$prop->id."/edit"}}>
        <div class="absolute bottom-0 right-0 flex items-center px-4 py-2 bg-blue-900">
            @include('svgs/edit')
            <p class="ml-2">Edit</p>
        </div>
    </a>
@stop