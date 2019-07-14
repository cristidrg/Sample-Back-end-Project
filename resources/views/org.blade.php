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
                    NU Props, a humble start | {{$org->title}}
                </div>
                <ul>
                     @foreach ($childrenOrgs as $childOrg)
                        <a href="/org/{{$childOrg->id}}"><li class="org">ORG: {{$childOrg->title}}</li></a>
                     @endforeach
                     @foreach ($childrenProps as $prop)
                        <a href="/prop/{{$prop->id}}"><li class="prop">PROP: {{$prop->title}}</li></a>
                     @endforeach
                </ul>
            </div>
        </div>
    </body>
</html>
