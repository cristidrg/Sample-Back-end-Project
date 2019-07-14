<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

        <!-- Styles -->
        <style>
          
        </style>
    </head>
    <body>
        <div class="">
            <div class="">
                <div class="">
                    NU Props, a humble start
                </div>
                <ul>
                     @foreach ($topLevelOrgs as $org)
                        <a href="/org/{{$org->id}}"><li class="org">ORG: {{$org->title}}</li></a>
                     @endforeach
                     @foreach ($topLevelProps as $prop)
                        <a href="/prop/{{$prop->id}}"><li class="prop">PROP: {{$prop->title}}</li></a>
                     @endforeach
                </ul>
            </div>
        </div>
    </body>
</html>
