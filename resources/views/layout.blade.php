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
        <div class="nav">
            <div>
            Dev Links: <a href="/prop">props</a> <a href="/org">orgs</a> <a href="/technology">techs</a> <a href="/user">users</a>
            </div>
            <div class="nav__icons">
                <a class="nav__home fs-d3 fw-300 tc-gray-100" href="/">NUProps</a>
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
                    <input class="nav__search bg-black" name="search_title" type="text" placeholder="Search Properties"
                    value="{{$q}}">

                    <div class="nav__filters">
                        <label class="nav__option">Uptime</label>

                        <div class="form__check nav__filter-group d-flex flex-col">
                            <label><input name="monitor" type="radio" value="up" {{$monitor_up != 'false' ? "checked" : ''}}>Up</label>
                            <label><input name="monitor" type="radio" value="down" {{$monitor_down != 'false' ? "checked": ''}}>Down</label>
                        </div>
                        <label class="nav__option">Accessibility</label>
                        <div class="form__check nav__filter-group d-flex flex-col">
                            <label><input name="a11y" type="radio" value="green" {{$a11y_green != 'false' ? "checked" : ''}}>90-100</label>
                            <label><input name="a11y" type="radio" value="yellow" {{$a11y_yellow != 'false' ? "checked" : ''}}>50-89</label>
                            <label><input name="a11y" type="radio" value="red" {{$a11y_red != 'false' ? "checked" : ''}}>0-49</label>
                        </div>

                        <label class="nav__option">SEO</label>
                        <div class="form__check nav__filter-group d-flex flex-col">
                            <label><input name="seo" type="radio" value="green" {{$seo_green != 'false' ? "checked" : ''}}>90-100</label>
                            <label><input name="seo" type="radio" value="yellow" {{$seo_yellow != 'false' ? "checked" : ''}}>50-89</label>
                            <label><input name="seo" type="radio" value="red" {{$seo_red != 'false' ? "checked" : ''}}>0-49</label>
                        </div>

                        <label class="nav__option">Performance</label>
                        <div class="form__check nav__filter-group d-flex flex-col">
                            <label><input name="perf" type="radio" value="green" {{$perf_green != 'false' ? "checked" : ''}}>90-100</label>
                            <label><input name="perf" type="radio" value="yellow" {{$perf_yellow != 'false' ? "checked" : ''}}>50-89</label>
                            <label><input name="perf" type="radio" value="red" {{$perf_red != 'false' ? "checked" : ''}}>0-49</label>
                        </div>
                    </div>
                    <button class="nav__form-submit btn bg-red" type="submit">Filter</button>
                </form>
            </nav>
        </div>

        <main class="w-full ml-10 mt-12 mr-16">
            @yield('content')
        </main>
    </body>

    <script type="text/javascript" src="/js/app.js"></script>
</html>
