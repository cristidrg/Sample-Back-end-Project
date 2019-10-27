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
        <div class="w-full lg:w-3/12 bg-gray-800 py-6 lg:py-10 px-2 lg:px-8">
            <div class="lg:fixed lg:w-2/12">
                <div class="flex items-center w-full">
                    <a class="text-2xl font-bold" href="/">NUprops</a>
                    <div class="nav__handle ml-auto lg:hidden">
                        @include('svgs/menu')
                    </div>
                </div>
                <nav id="navigation" data-navigation-handle=".nav__handle" role="navigation">
                    <form action="/search" class="bg-gray-800" method="POST" role="search">
                        @csrf
                        <input class="my-8 w-full bg-transparent py-2 px-1 border border-gray-400" name="search_title" type="text" placeholder="Search Properties"
                        value="{{$q}}">

                        <div class="nav__filters mb-8 text-gray-600">
                            <div class="mb-6">
                                <h2 class="text-white font-medium">Uptime</h2>
                                <label class="block"><input class="mr-1" name="monitor" type="radio" value="up" {{$monitor == 'up' ? "checked" : ''}}>Up</label>
                                <label class="block"><input class="mr-1" name="monitor" type="radio" value="down" {{$monitor == 'down' ? "checked": ''}}>Down</label>
                            </div>
                            <div class="mb-6">
                                <h2 class="text-white font-medium">Accessibility</h2>
                                <label class="block"><input class="mr-1" name="a11y" type="radio" value="green" {{$a11y == 'green' ? "checked" : ''}}>90-100</label>
                                <label class="block"><input class="mr-1" name="a11y" type="radio" value="yellow" {{$a11y == 'yellow' ? "checked" : ''}}>50-89</label>
                                <label class="block"><input class="mr-1" name="a11y" type="radio" value="red" {{$a11y == 'red' ? "checked" : ''}}>0-49</label>
                            </div>

                            <div class="mb-6">
                                <h2 class="text-white font-medium">SEO</h2>
                                <label class="block"><input class="mr-1" name="seo" type="radio" value="green" {{$seo == 'green' ? "checked" : ''}}>90-100</label>
                                <label class="block"><input class="mr-1" name="seo" type="radio" value="yellow" {{$seo == 'yellow' ? "checked" : ''}}>50-89</label>
                                <label class="block"><input class="mr-1" name="seo" type="radio" value="red" {{$seo == 'red' ? "checked" : ''}}>0-49</label>
                            </div>

                            <div class="mb-6">
                                <h2 class="text-white font-medium">Performance</h2>
                                <label class="block"><input class="mr-1" name="perf" type="radio" value="green" {{$perf == 'green' ? "checked" : ''}}>90-100</label>
                                <label class="block"><input class="mr-1" name="perf" type="radio" value="yellow" {{$perf == 'yellow' ? "checked" : ''}}>50-89</label>
                                <label class="block"><input class="mr-1" name="perf" type="radio" value="red" {{$perf == 'red' ? "checked" : ''}}>0-49</label>
                            </div>
                        </div>
                        <button class="block w-full px-4 py-3 bg-gray-900 hover:bg-gray-700 text-white" type="submit">Filter</button>
                        <button class="block w-full mt-2 px-4 py-3 bg-gray-700 hover:bg-gray-700 text-white" type="submit">Clear</button>
                    </form>
                </nav>
            </div>
        </div>

        <main class="w-full pl-2 lg:pl-10 pt-12 pr-2 lg:pr-16 relative pb-6">
            <div>
                Dev Links: <a href="/prop">props</a> <a href="/org">orgs</a> <a href="/technology">techs</a> <a href="/user">users</a>
            </div>
            @yield('content')
        </main>
    </body>

    <script type="text/javascript" src="/js/app.js"></script>
</html>
