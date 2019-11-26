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
    <body class="flex flex-col text-gray-200 bg-gray-900 font-body lg:flex-row">
        <div class="z-10 w-full px-3 py-6 bg-gray-800 lg:fixed lg:w-3/12 lg:h-full lg:py-10 lg:px-8">
            <div class="flex items-center w-full">
                <a class="text-2xl font-bold text-gray-100" href="/">NUprops</a>
                <div class="ml-auto nav__handle lg:hidden">
                    @include('svgs/menu')
                </div>
            </div>
            <nav id="navigation" class="flex flex-col h-full" data-navigation-handle=".nav__handle" role="navigation">
                <form id="nav_form" action="/search" class="flex flex-col py-8 bg-gray-800" method="POST" role="search">
                    @csrf
                    <input class="w-full px-1 py-2 mb-8 bg-transparent border border-gray-400" name="search_title" type="text" placeholder="Search Properties"
                    value="{{$q}}">

                    <div class="text-sm text-gray-600 nav__filters 4">
                        <div class="mb-4">
                            <h2 class="text-base font-medium text-white">Uptime</h2>
                            <label class="block"><input class="mr-1" name="monitor" type="radio" value="up" {{$monitor == 'up' ? "checked" : ''}}>Up</label>
                            <label class="block"><input class="mr-1" name="monitor" type="radio" value="down" {{$monitor == 'down' ? "checked": ''}}>Down</label>
                        </div>
                        <div class="mb-4">
                            <h2 class="text-base font-medium text-white">Accessibility</h2>
                            <label class="block"><input class="mr-1" name="a11y" type="radio" value="green" {{$a11y == 'green' ? "checked" : ''}}>90-100</label>
                            <label class="block"><input class="mr-1" name="a11y" type="radio" value="yellow" {{$a11y == 'yellow' ? "checked" : ''}}>50-89</label>
                            <label class="block"><input class="mr-1" name="a11y" type="radio" value="red" {{$a11y == 'red' ? "checked" : ''}}>0-49</label>
                        </div>

                        <div class="mb-4">
                            <h2 class="text-base font-medium text-white">SEO</h2>
                            <label class="block"><input class="mr-1" name="seo" type="radio" value="green" {{$seo == 'green' ? "checked" : ''}}>90-100</label>
                            <label class="block"><input class="mr-1" name="seo" type="radio" value="yellow" {{$seo == 'yellow' ? "checked" : ''}}>50-89</label>
                            <label class="block"><input class="mr-1" name="seo" type="radio" value="red" {{$seo == 'red' ? "checked" : ''}}>0-49</label>
                        </div>

                        <div class="mb-4">
                            <h2 class="text-base font-medium text-white">Performance</h2>
                            <label class="block"><input class="mr-1" name="perf" type="radio" value="green" {{$perf == 'green' ? "checked" : ''}}>90-100</label>
                            <label class="block"><input class="mr-1" name="perf" type="radio" value="yellow" {{$perf == 'yellow' ? "checked" : ''}}>50-89</label>
                            <label class="block"><input class="mr-1" name="perf" type="radio" value="red" {{$perf == 'red' ? "checked" : ''}}>0-49</label>
                        </div>
                    </div>
                    <button class="block w-full px-4 py-2 text-white bg-gray-900 hover:bg-gray-700" type="submit">Filter</button>
                    <button id="nav_clear" class="block w-full py-2 mt-2 text-white bg-gray-700 hover:bg-gray-700" type="button">Clear</button>
                </form>
                <div class="flex flex-col mt-auto mb-4 text-xs text-blue-300">
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

        <main class="relative w-full px-4 pt-12 pb-6 lg:pl-container lg:pr-16">
            @yield('content')
        </main>
    </body>

    <script type="text/javascript" src="/js/app.js"></script>
</html>
