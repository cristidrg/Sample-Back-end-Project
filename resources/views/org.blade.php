<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        
        <!-- Styles -->
        <link rel="stylesheet" href="/css/app.css">
    </head>
    <body class="props-body">
        <nav class="nav">
            <a class="nav__home" href="/">NUProps</a>
            <svg class="nav__burger" width="21" height="15" viewBox="0 0 21 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                <line y1="0.5" x2="21" y2="0.5" stroke="#EFEFEF"/>
                <line y1="7.5" x2="21" y2="7.5" stroke="#EFEFEF"/>
                <line y1="14.5" x2="21" y2="14.5" stroke="#EFEFEF"/>
            </svg>

            <input class="nav__search" type="text" placeholder="Search Properties">
        </nav>

        <main>
            <h1 class="props-header">{{$org->title}}</h1>

            <div class="charts">
                <div class="charts__entry">
                    <div class="charts__canvas-container">
                        <canvas id="uptime"></canvas>
                    </div>
                    <label class="charts__label">Uptime</label>
                </div>
                <div class="charts__entry">
                    <div class="charts__canvas-container">
                        <canvas id="accessibility"></canvas>
                    </div>
                    <label class="charts__label">Accessibility</label>
                </div>
            </div>

            <ul class="prop-list">
                @foreach ($childrenProps as $prop)
                    <a class="prop-list__entry" href="/prop/{{$prop->id}}">
                        <li class="prop-list__p-wrapper">
                            {{$prop->title}}
                            <span class="prop-list__url">{{$prop->url}}</span>
                        </li>
                    </a>
                @endforeach
                @foreach ($childrenOrgs as $childOrg)
                    <a class="prop-list__entry" href="/org/{{$childOrg->id}}">
                        <li class="prop-list__wrapper">
                            {{$childOrg->title}} 
                            <span class="prop-list__count">{{count($childOrg->children) + count($childOrg->props)}}</span>
                        </li>
                    </a>
                @endforeach
            </ul>
        </main>
    </body>

    <script type="text/javascript" src="/js/app.js"></script>
</html>
