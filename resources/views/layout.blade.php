@php
    isset($q) ? '' : $q = '';
    isset($a11y_green) ? '' : $a11y_green = 'false';
    isset($a11y_yellow) ? '' : $a11y_yellow = 'false';
    isset($a11y_red) ? '' : $a11y_red = 'false';
    isset($seo_green) ? '' : $seo_green = 'false';
    isset($seo_yellow) ? '' : $seo_yellow = 'false';
    isset($seo_red) ? '' : $seo_red = 'false';
    isset($perf_green) ? '' : $perf_green = 'false';
    isset($perf_yellow) ? '' : $perf_yellow = 'false';
    isset($perf_red) ? '' : $perf_red = 'false';
    isset($monitor_up) ? '' : $monitor_up = 'false';
    isset($monitor_down) ? '' : $monitor_down = 'false';
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
    <body class="bg-gray-900 font-body props-body">
        <div class="nav bg-gray-800 py-12 px-8">
            <div class="nav__icons">
                <a class="text-2xl font-bold" href="/">NUprops</a>
                <div class="nav__handle">
                    <!-- TODO: ADD SEARCH ICON -->
                    <svg class="nav__burger " width="21" height="15" viewBox="0 0 21 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <line y1="0.5" x2="21" y2="0.5" stroke="#EFEFEF"/>
                        <line y1="7.5" x2="21" y2="7.5" stroke="#EFEFEF"/>
                        <line y1="14.5" x2="21" y2="14.5" stroke="#EFEFEF"/>
                    </svg>
                </div>
            </div>
            <nav id="navigation" data-navigation-handle=".nav__handle" role="navigation">
                <form action="/search" method="POST" role="search">
                    @csrf
                    <input class="my-16" name="search_title" type="text" placeholder="Search Properties"
                    value="{{$q}}">

                    <div class="nav__filters mb-8">
                        <div class="mb-6">
                            <h2 class="text-white font-medium">Uptime</h2>
                            <label class="block"><input name="monitor" type="radio" value="up" {{$monitor_up != 'false' ? "checked" : ''}}>Up</label>
                            <label class="block"><input name="monitor" type="radio" value="down" {{$monitor_down != 'false' ? "checked": ''}}>Down</label>
                        </div>
                        <div class="mb-6">
                            <h2 class="text-white font-medium">Accessibility</h2>
                            <label class="block"><input name="a11y" type="radio" value="green" {{$a11y_green != 'false' ? "checked" : ''}}>90-100</label>
                            <label class="block"><input name="a11y" type="radio" value="yellow" {{$a11y_yellow != 'false' ? "checked" : ''}}>50-89</label>
                            <label class="block"><input name="a11y" type="radio" value="red" {{$a11y_red != 'false' ? "checked" : ''}}>0-49</label>
                        </div>

                        <div class="mb-6">
                            <h2 class="text-white font-medium">SEO</h2>
                            <label class="block"><input name="seo" type="radio" value="green" {{$seo_green != 'false' ? "checked" : ''}}>90-100</label>
                            <label class="block"><input name="seo" type="radio" value="yellow" {{$seo_yellow != 'false' ? "checked" : ''}}>50-89</label>
                            <label class="block"><input name="seo" type="radio" value="red" {{$seo_red != 'false' ? "checked" : ''}}>0-49</label>
                        </div>

                        <div class="mb-6">
                            <h2 class="text-white font-medium">Performance</h2>
                            <label class="block"><input name="perf" type="radio" value="green" {{$perf_green != 'false' ? "checked" : ''}}>90-100</label>
                            <label class="block"><input name="perf" type="radio" value="yellow" {{$perf_yellow != 'false' ? "checked" : ''}}>50-89</label>
                            <label class="block"><input name="perf" type="radio" value="red" {{$perf_red != 'false' ? "checked" : ''}}>0-49</label>
                        </div>
                    </div>
                    <button class="block w-full px-4 py-3 bg-gray-900 hover:bg-gray-700 text-white" type="submit">Filter</button>
                </form>

                <div class="pt-12">
                    Dev Links: <a href="/prop">props</a> <a href="/org">orgs</a> <a href="/technology">techs</a> <a href="/user">users</a>
                </div>
            </nav>
        </div>

        <main class="w-full ml-10 mt-12 mr-16">
            @yield('content')
        </main>
    </body>

    <script type="text/javascript" src="/js/app.js"></script>
</html>
