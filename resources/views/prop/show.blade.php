@extends('layout')

@section('title', $prop->title)

@section('content')
    <nav class="text-base font-regular text-gray-500 mb-1">
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
        <a class="mt-2 ml-12 rounded-full text-xs text-black bg-gray-300 py-1 px-3" href="{{$prop->url}}">Visit Site</a>
    </div>
    <div class="flex flex-wrap mb-24">
        <div class="flex-grow w-full mt-12 lg:w-7/12">
            <p class="text-lg text-gray-200 font-bold uppercase">Audit</p>
            <div class="bg-gray-800 mt-6 py-10 pl-10 pr-8">
                <div class="flex flex-col">
                    <p class="text-gray-300">Accessibility</p>
                    <div class="flex mt-1">
                        <div class="flex-1 audit_bar h-5 bg-gray-700">
                            <span class="bg-blue-400" style="width: {{$prop->a11yScore * 100}}%"></span>
                        </div>
                        <p class="ml-6 text-large font-bold text-gray-200">{{$prop->a11yScore * 100}}</p>
                    </div>
                </div>
                <div class="flex flex-col mt-4">
                    <p class="text-gray-300">SEO</p>
                    <div class="flex mt-1">
                        <div class="flex-1 audit_bar h-5 bg-gray-700">
                            <span class="bg-blue-400" style="width: {{$prop->seoScore * 100}}%"></span>
                        </div>
                        <p class="ml-6 text-large font-bold text-gray-200">{{$prop->seoScore * 100}}</p>
                    </div>
                </div>
                <div class="flex flex-col mt-4">
                    <p class="text-gray-300">Performance</p>
                    <div class="flex mt-1">
                        <div class="flex-1 audit_bar h-5 bg-gray-700">
                            <span class="bg-blue-400" style="width: {{$prop->perfScore * 100}}%"></span>
                        </div>
                        <p class="ml-6 text-large font-bold text-gray-200">{{$prop->perfScore * 100}}</p>
                    </div>
                </div>
                <div class="mt-8 flex items-center">
                    @if($prop->monitor->uptime_status == 'down')
                        <div class="prop_status flex py-1 px-2 rounded-full bg-red-500 items-center text-xs text-gray-100">
                                @include('svgs/warning')
                            <p class="ml-2">Property Down</p>
                        </div>
                    @else
                        <div class="prop_status flex py-1 px-2 rounded-full bg-green-500 items-center text-xs text-gray-100">
                            @include('svgs/check')
                            <p class="ml-2">Property Up</p>
                        </div>
                    @endif
                    <p class="text-sm text-gray-500 ml-auto">Last performed: {{$prop->monitor->uptime_last_check_date}}</p>
                    <a href="/audits/{{$prop->id}}.html" class="text-xs ml-5 bg-gray-700 py-2 px-2">Full Lighthouse report</a>
                </div>
            </div>
        </div>
        <div class="flex flex-col w-full lg:w-3/12 lg:ml-8 mt-12">
            <p class="text-lg text-gray-200 font-bold uppercase">Contact</p>
            <div class="mt-6 flex-grow bg-blue-900 h-full py-2 pl-10 pr-8">
                @foreach ($contacts as $contact)
                    <div class="mt-6">
                        <p>{{$contact->first_name}} {{$contact->last_name}}</p>
                        <p class="text-m font-light">{{$contact->title}}</p>
                        <p class="mt-3 text-m font-light text-gray-500">{{$contact->email}}</p>
                    </div>
                @endforeach
            </div>
        </div>
        <div class="flex-grow w-full lg:w-7/12 flex flex-col mt-12">
            <p class="text-lg text-gray-200 font-bold uppercase">Environment</p>
            <div class="mt-6 bg-gray-800 h-full py-8 pl-10 pr-8 flex text-xs font-light">
                @if($prop->environments)
                    @foreach (json_decode($prop->environments) as $index=>$environment)
                        @if ($index == 0)
                            <div>
                        @else
                            <div class="ml-8">
                        @endif
                                <p class="text-base font-medium">{{$environment->type}}</p>
                                <p class="mt-2 uppercase">Server:</p>
                                <a class="text-blue-300" href="{{$environment->server}}">{{$environment->server}}</a>
                                <p class="mt-2">URL:</p> 
                                <a class="text-blue-300" href="{{$environment->url}}">{{$environment->url}}</a>
                            </div>
                    @endforeach
                @endif
            </div>
        </div>
        <div class="flex flex-col w-full lg:w-3/12 mt-12 lg:ml-8">
            <p class="text-lg text-gray-200 font-bold uppercase">Technology</p>
            <div class="mt-6 bg-gray-800 h-full py-8 pl-10 pr-8">
                <ul>
                    @foreach ($prop->technologies as $technology)
                        <li>{{$technology->name}}</li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>

    <a href={{"/prop"."/".$prop->id."/edit"}}>
        <div class="flex items-center bg-blue-900 py-2 px-4 absolute right-0 bottom-0">
            @include('svgs/edit')
            <p class="ml-2">Edit</p>
        </div>
    </a>
@stop