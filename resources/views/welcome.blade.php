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
        <div class="flex-center position-ref full-height">
            <div class="">
                <div class="title m-b-md">
                    NU Props, a humble start
                </div>
                <ul>
                     @foreach ($orgs as $org)
                        <li class="org">{{$org->title}}</li>
                     @endforeach
                </ul>
                   
                        <h3>{{$org->title}}</h3>
                        <ul>

                        </ul>
                    @endforeach
            </div>
        </div>
    </body>
</html>
