@extends('layout', [
    'a11y' => $a11y,
    'seo' => $seo,
    'perf' => $perf,
    'monitor' => $monitor,
])

@section('title', 'Home')

@section('content')
    <h1 class="text-3xl font-bold">Search Results</h1>
    <p class="text-xl mt-3">{{count($propResults)}} Results Found</p>
    <ul class="prop-list mt-12">
       @foreach ($propResults as $prop)
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
                                <span class="bg-blue-400" style="width: {{$prop->a11yScore}}%"></span>
                            </div>
                        </div>
                        <div class="flex-1 ml-6">
                            <p class="mb1">SEO</p>
                            <div class="audit_bar mt-4 h-2 w-full lg:w-32 bg-gray-700">
                                <span class="bg-blue-400" style="width: {{$prop->seoScore}}%"></span>
                            </div>
                        </div>
                        <div class="flex-1 ml-6">
                            <p class="mb1">Performance</p>
                            <div class="audit_bar mt-4 h-2 w-full lg:w-32 bg-gray-700">
                                <span class="bg-blue-400" style="width: {{$prop->perfScore}}%"></span>
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
@stop
