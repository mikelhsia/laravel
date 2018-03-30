<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>My Layout Application</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

        <!-- Style -->
        <link href="/css/app.css" rel='stylesheet'>
    </head>
    <body>
        @if ($flash = session('message'))
            <div style="background: darkseagreen; color:darkgreen; border:1px solid seagreen;">
                {{ $flash }}
            </div>
        @endif

    	@yield('content')
        @yield('footer')
    </body>
</html>
