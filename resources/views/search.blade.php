@extends('layouts/default', [
    'a11y' => $a11y,
    'seo' => $seo,
    'perf' => $perf,
    'monitor' => $monitor,
])

@section('title', 'Home')

@section('content')
    <h1 class="text-3xl font-bold">Search Results</h1>
    <p class="mt-3 text-xl">{{count($propResults)}} Results Found</p>
    <ul class="mt-12 prop-list">
       @foreach ($propResults as $prop)
            <li class="block px-2 border-b border-gray-800 border-solid hover:bg-gray-800 ">
                <a class="relative flex flex-col pt-4 pb-4 lg:flex-row" href="/prop/{{$prop->id}}">
                    <div class="flex flex-col justify-center">
                        <p class="mb-1 text-base font-medium text-gray-200">{{$prop->title}}</p>
                        <p class="text-sm text-gray-700">{{$prop->url}}</p>
                    </div>
                    <div class="flex items-center mt-6 text-gray-500 lg:mt-0 lg:ml-auto">
                        <div class="flex-1">
                            <p class="mb1">Accessibility</p>
                            <div class="w-full h-2 mt-4 bg-gray-700 audit_bar lg:w-32">
                                <span class="bg-blue-400" style="width: {{$prop->a11yScore}}%"></span>
                            </div>
                        </div>
                        <div class="flex-1 ml-6">
                            <p class="mb1">SEO</p>
                            <div class="w-full h-2 mt-4 bg-gray-700 audit_bar lg:w-32">
                                <span class="bg-blue-400" style="width: {{$prop->seoScore}}%"></span>
                            </div>
                        </div>
                        <div class="flex-1 ml-6">
                            <p class="mb1">Performance</p>
                            <div class="w-full h-2 mt-4 bg-gray-700 audit_bar lg:w-32">
                                <span class="bg-blue-400" style="width: {{$prop->perfScore}}%"></span>
                            </div>
                        </div>
                    </div>
                    <div class="absolute right-0 flex flex-col items-center ml-12 lg:static top-1 lg:top-auto">
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
@stop
