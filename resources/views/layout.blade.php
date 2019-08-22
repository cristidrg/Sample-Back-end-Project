<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>NU PROPS - @yield('title')</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        
        <!-- Styles -->
        <link rel="stylesheet" href="/css/app.css">
    </head>
    <body class="props-body">
        <div class="nav">
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
                    {{ csrf_field() }}
                    <input class="nav__search bg-black" name="search_title" type="text" placeholder="Search Properties">
                    <div class="nav__filters">
                        <label class="nav__option">Uptime</label>
                        <div class="form__check nav__filter-group d-flex flex-col">
                            <label><input name="monitor_up" type="checkbox">Up</label>
                            <label><input name="monitor_down" type="checkbox">Down</label>
                        </div>

                        <label class="nav__option">Accessibility</label>
                        <div class="form__check nav__filter-group d-flex flex-col">
                            <label><input name="a11y_green" type="checkbox">90-100</label>
                            <label><input name="a11y_yellow" type="checkbox">50-89</label>
                            <label><input name="a11y_red" type="checkbox">0-49</label>
                        </div>

                        <label class="nav__option">SEO</label>
                        <div class="form__check nav__filter-group d-flex flex-col">
                            <label><input name="seo_green" type="checkbox">90-100</label>
                            <label><input name="seo_yellow" type="checkbox">50-89</label>
                            <label><input name="seo_red" type="checkbox">0-49</label>
                        </div>

                        <label class="nav__option">Performance</label>
                        <div class="form__check nav__filter-group d-flex flex-col">
                            <label><input name="perf_green" type="checkbox">90-100</label>
                            <label><input name="perf_yellow" type="checkbox">50-89</label>
                            <label><input name="perf_red" type="checkbox">0-49</label>
                        </div>
                    </div>
                    <button class="nav__form-submit btn bg-red" type="submit">Filter</button>
                </form>
            </nav>
        </div>

        <main class="main section">
            @yield('content')
        </main>
    </body>

    <script type="text/javascript" src="/js/app.js"></script>
</html>
