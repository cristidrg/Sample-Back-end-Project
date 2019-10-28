@php
    isset($q) ? '' : $q = '';
    isset($seo) ? '' : $seo = 'false';
    isset($a11y) ? '' : $a11y = 'false';
    isset($perf) ? '' : $perf = 'false';
    isset($monitor) ? '' : $monitor = 'false';
@endphp

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>NU PROPS - @yield('title')</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Barlow:300,400,500,700&display=swap" rel="stylesheet">

        <!-- Styles -->
        <link rel="stylesheet" href="/css/app.css" }}>
        <link rel="stylesheet" href="/tailwind/app.css" }}>
    </head>
    <body class="bg-gray-900 font-body flex flex-col lg:flex-row text-gray-200">
        <div class="w-full lg:fixed z-10 lg:w-3/12 lg:h-full bg-gray-800 py-6 lg:py-10 px-2 lg:px-8">
            <div class="flex items-center w-full">
                <a class="text-2xl font-bold" href="/">NUprops</a>
                <div class="nav__handle ml-auto lg:hidden">
                    @include('svgs/menu')
                </div>
            </div>
            <nav id="navigation" class="h-full flex flex-col" data-navigation-handle=".nav__handle" role="navigation">
                <form action="/search" class="bg-gray-800 flex py-8 flex-col" method="POST" role="search">
                    @csrf
                    <input class="mb-8 w-full bg-transparent py-2 px-1 border border-gray-400" name="search_title" type="text" placeholder="Search Properties"
                    value="{{$q}}">

                    <div class="nav__filters 4 text-sm text-gray-600">
                        <div class="mb-4">
                            <h2 class="text-white text-base font-medium">Uptime</h2>
                            <label class="block"><input class="mr-1" name="monitor" type="radio" value="up" {{$monitor == 'up' ? "checked" : ''}}>Up</label>
                            <label class="block"><input class="mr-1" name="monitor" type="radio" value="down" {{$monitor == 'down' ? "checked": ''}}>Down</label>
                        </div>
                        <div class="mb-4">
                            <h2 class="text-white text-base font-medium">Accessibility</h2>
                            <label class="block"><input class="mr-1" name="a11y" type="radio" value="green" {{$a11y == 'green' ? "checked" : ''}}>90-100</label>
                            <label class="block"><input class="mr-1" name="a11y" type="radio" value="yellow" {{$a11y == 'yellow' ? "checked" : ''}}>50-89</label>
                            <label class="block"><input class="mr-1" name="a11y" type="radio" value="red" {{$a11y == 'red' ? "checked" : ''}}>0-49</label>
                        </div>

                        <div class="mb-4">
                            <h2 class="text-white text-base font-medium">SEO</h2>
                            <label class="block"><input class="mr-1" name="seo" type="radio" value="green" {{$seo == 'green' ? "checked" : ''}}>90-100</label>
                            <label class="block"><input class="mr-1" name="seo" type="radio" value="yellow" {{$seo == 'yellow' ? "checked" : ''}}>50-89</label>
                            <label class="block"><input class="mr-1" name="seo" type="radio" value="red" {{$seo == 'red' ? "checked" : ''}}>0-49</label>
                        </div>

                        <div class="mb-4">
                            <h2 class="text-white text-base font-medium">Performance</h2>
                            <label class="block"><input class="mr-1" name="perf" type="radio" value="green" {{$perf == 'green' ? "checked" : ''}}>90-100</label>
                            <label class="block"><input class="mr-1" name="perf" type="radio" value="yellow" {{$perf == 'yellow' ? "checked" : ''}}>50-89</label>
                            <label class="block"><input class="mr-1" name="perf" type="radio" value="red" {{$perf == 'red' ? "checked" : ''}}>0-49</label>
                        </div>
                    </div>
                    <button class="block w-full px-4 py-2 bg-gray-900 hover:bg-gray-700 text-white" type="submit">Filter</button>
                    <button class="block w-full mt-2 py-2 bg-gray-700 hover:bg-gray-700 text-white" type="submit">Clear</button>
                </form>
                <div class="mt-auto mb-4 flex flex-col text-xs text-blue-300">
                    <div class="flex items-center">
                        @include('svgs/edit')
                        <p class="ml-1 text-blue-200">Administrator View</p>
                    </div>
                    
                    <a class="ml-4" href="/org">Organizations</a>
                    <a class="ml-4" href="/prop">Properties</a>
                    <a class="ml-4" href="/user">Users</a>
                    <a class="ml-4" href="/technology">Technologies</a> 
                </div>
            </nav>
        </div>

        <main class="w-full pl-2 lg:pl-container pt-12 pr-2 lg:pr-16 relative pb-6">
            @yield('content')
        </main>
    </body>

    <script type="text/javascript" src="/js/app.js"></script>
</html>
